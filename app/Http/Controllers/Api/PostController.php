<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use App\Service\CommonService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function __construct(Category $category, User $user, CommonService $commonService, Post $post)
    {
        $this->category      = $category;
        $this->user          = $user;
        $this->commonService = $commonService;
        $this->post          = $post;
    }

    /**
     * @return json
     */
    public function index(Request $request)
    {
        $resultToken = $this->commonService->checkUserToken($request, $this->user);
        if (0 == $resultToken['status']) {
            return $resultToken;
        }
        $limit     = 2;
        $page      = $request->query('page', 1);
        $offset    = ($page - 1) * $limit;
        $totalData = $this->post->with('user')
            ->whereHas('category', function ($q) {
                $q->where('deleted_at', null);
            })->count();
        $posts = $this->post->with('user')
            ->whereHas('category', function ($q) {
                $q->where('deleted_at', null);
            })->offset($offset)->limit($limit)->get();
        return response()->json([
            'status'    => 1,
            'msg'       => 'success',
            'data'      => $posts,
            'page'      => $page,
            'totalPage' => ceil($totalData / $limit),
        ]);
    }

    /**
     * @return json
     */
    public function doAdd(Request $request)
    {
        $resultToken = $this->commonService->checkUserToken($request, $this->user);
        if (0 == $resultToken['status']) {
            return $resultToken;
        }
        $title      = $request->input('title', '');
        $slug       = Str::slug(stripVN($title), '-');
        $summary    = $request->input('summary', '');
        $content    = $request->input('content', '');
        $avatar     = saveProductImageBase64($request->avatar, $request, $folder = 'post');
        $categoryId = $request->input('category_id');
        $authorId   = $resultToken['user']->id;
        $inserted   = $this->post->create([
            'title'     => $title,
            'slug'      => $slug,
            'summary'   => $summary,
            'content'   => $content,
            'avatar'    => $avatar,
            'author_id' => $authorId,
        ]);
        $inserted->category()->attach($categoryId);
        return response()->json([
            'status' => 1,
            'msg'    => 'success',
        ]);
    }

    /**
     * @param integer $id
     *
     * @return view
     */
    public function edit($id)
    {
        $post = $this->post->find($id);
        if (!$post) {
            return response()->json([
                'status' => 0,
                'msg'    => 'Post does not exist',
            ]);
        }
        $postCategory = [];
        foreach ($post->category as $item) {
            $postCategory[] = $item->id;
        }
        return response()->json([
            'status' => 1,
            'msg'    => 'success',
            'data'   => [
                'post'         => $post,
                'postCategory' => $postCategory,
            ],
        ]);
    }

    /**
     * @param Request $request
     *
     * @return redirect
     */
    public function doEdit(Request $request, $id)
    {
        $resultToken = $this->commonService->checkUserToken($request, $this->user);
        if (0 == $resultToken['status']) {
            return $resultToken;
        }

        $post = $this->post->find($id);
        if (!$post) {
            return response()->json([
                'status' => 0,
                'msg'    => 'Post does not exist',
            ]);
        }
        $oldCategory = [];
        foreach ($post->category as $item) {
            $oldCategory[] = $item->id;
        }

        $title   = $request->input('title', '');
        $slug    = Str::slug(stripVN($title), '-');
        $summary = $request->input('summary', '');
        $content = $request->input('content', '');
        $avatar  = saveProductImageBase64($request->avatar, $request, $folder = 'post', $post->avatar);

        $categoryId = $request->input('category_id');
        $authorId   = $resultToken['user']->id;
        $updated    = $post->update([
            'title'     => $title,
            'slug'      => $slug,
            'summary'   => $summary,
            'content'   => $content,
            'avatar'    => $avatar,
            'author_id' => $authorId,
        ]);
        $post->category()->detach($oldCategory);
        $post->category()->attach($categoryId);

        return response()->json([
            'status' => 1,
            'msg'    => 'success',
        ]);
    }

    /**
     * @param integer id
     *
     * @return json
     */
    public function delete(Request $request, $id)
    {
        $resultToken = $this->commonService->checkUserToken($request, $this->user);
        if (0 == $resultToken['status']) {
            return $resultToken;
        }

        $post = $this->post->find($id);
        if (!$post) {
            return response()->json([
                'status' => 0,
                'msg'    => 'Post does not exist',
            ]);
        }
        $post->delete();
        return response()->json([
            'status' => 1,
            'msg'    => 'success',
        ]);
    }
}
