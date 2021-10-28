<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RequestPost;
use App\Models\Post;
use App\Models\Category;
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
        $resultToken = $this->commonService->checkUserToken($request);
        if (0 == $resultToken['status']) {
            return $resultToken;
        }
        $posts = $this->post->with('user')
            ->whereHas('category', function ($q) {
                $q->where('deleted_at', null);
            })
            ->simplePaginate(config('constants.paging_admin'));
        return response()->json([
            'status' => 1,
            'msg'    => 'success',
            'data'   => $posts,
        ]);
    }

    /**
     * @return json
     */
    public function doAdd(Request $request)
    {
        $resultToken = $this->commonService->checkUserToken($request);
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
        $inserted->category()->attach($categoryId[0]);
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
        $category = $this->category->find($id);
        if (!$category) {
            return response()->json([
                'status' => 0,
                'msg'    => 'Category does not exist',
            ]);
        }
        $categories = $this->category->where('parent_id', null)->get();
        return response()->json([
            'status' => 1,
            'msg'    => 'success',
            'data'   => $category,
        ]);
    }

    /**
     * @param Request $request
     *
     * @return redirect
     */
    public function doEdit(RequestCategory $request, $id)
    {
        $category = $this->category->find($id);
        if (!$category) {
            return response()->json([
                'status' => 0,
                'msg'    => 'Category does not exist',
            ]);
        }
        $category->title     = $request->title;
        $category->slug      = Str::slug(stripVN($request->title), '-');
        $category->content   = $request->content;
        $category->parent_id = $request->parent_id;
        $category->save();
        return response()->json([
            'status' => 1,
            'msg'    => 'success',
        ]);
    }

    /**
     * @param integer $id
     *
     * return view
     */
    public function children($id)
    {
        $category = $this->category->find($id);
        if (!$category) {
            return redirect()->route('admin.category.index');
        }
        return view('admin.category.children', [
            'category' => $category,
        ]);
    }

    /**
     * @param integer id
     *
     * @return redirect
     */
    public function delete($id)
    {
        $category = $this->category::find($id);
        if (!$category) {
            return response()->json([
                'status' => 0,
                'msg'    => 'Category does not exist',
            ]);
        }
        $category->delete();
        return response()->json([
            'status' => 1,
            'msg'    => 'success',
        ]);
    }
}
