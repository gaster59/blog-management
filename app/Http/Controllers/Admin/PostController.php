<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RequestPost;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Events\WriteLogEvent;
use App\Exports\UserExport;
use App\Exports\UserCsvExport;
use Maatwebsite\Excel\Facades\Excel;

class PostController extends Controller
{
    public function __construct(Post $post, Category $category)
    {
        $this->post     = $post;
        $this->category = $category;
    }

    /**
     * @return view
     */
    public function index()
    {
        // $posts = $this->post->simplePaginate(config('constants.paging_admin'));
        event(new WriteLogEvent());
        $posts = $this->post
            ->whereHas('category', function ($q) {
                $q->where('deleted_at', null);
            })
            ->simplePaginate(config('constants.paging_admin'));
        return view('admin.post.index', [
            'posts' => $posts,
        ]);
    }

    /**
     * @return view
     */
    public function add()
    {
        $categories = $this->category->with('childCategory')->where('parent_id', null)->get();
        return view('admin.post.add', [
            'categories' => $categories,
        ]);
    }

    /**
     * @param RequestPost $request
     * 
     * @return redirect
     */
    public function doAdd(RequestPost $request)
    {
        $title      = $request->input('title', '');
        $slug       = Str::slug(stripVN($title), '-');
        $summary    = $request->input('summary', '');
        $content    = $request->input('content', '');
        $avatar     = uploadImage($request, $folder = 'post', $control = 'avatar');
        $categoryId = $request->input('category_id');
        $authorId   = Auth::guard('admin')->user()->id;
        $inserted   = $this->post->create([
            'title'     => $title,
            'slug'      => $slug,
            'summary'   => $summary,
            'content'   => $content,
            'avatar'    => $avatar,
            'author_id' => $authorId,
        ]);
        $inserted->category()->attach($categoryId[0]);
        return redirect()->route('admin.post.add')->with('success', 'Insert success');
    }

    /**
     * @param interger $id
     * 
     * @return view
     */
    public function edit($id)
    {
        $post = $this->post->find($id);
        if (!$post) {
            return redirect()->route('admin.post.index')->with('alert', 'Post does not exist');
        }

        $postCategory = [];
        foreach ($post->category as $item) {
            $postCategory[] = $item->id;
        }
        $categories = $this->category->with('childCategory')->where('parent_id', null)->get();
        return view('admin.post.edit', [
            'categories'   => $categories,
            'post'         => $post,
            'postCategory' => $postCategory,
        ]);
    }

    /**
     * @param RequestPost $request
     * @param integer $id
     * 
     * @return redirect
     */
    public function doEdit(RequestPost $request, $id)
    {
        $post        = $this->post->find($id);
        $oldCategory = [];
        foreach ($post->category as $item) {
            $oldCategory[] = $item->id;
        }
        $title   = $request->input('title', '');
        $slug    = Str::slug(stripVN($title), '-');
        $summary = $request->input('summary', '');
        $content = $request->input('content', '');
        $avatar  = $post->avatar;
        if ($request->file('avatar')) {
            $avatar = uploadImage($request, $folder = 'post', $control = 'avatar');
        }

        $categoryId = $request->input('category_id');
        $authorId   = Auth::guard('admin')->user()->id;
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
        return redirect()->route('admin.post.index');
    }

    public function download()
    {
        // return Excel::download(new UserExport, 'user.xlsx');
        return Excel::download(new UserCsvExport($id = 1), 'user.csv');
    }
}
