<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    public function index()
    {
        $posts = $this->post->simplePaginate(config('constants.paging_frontend'));
        return view('home.index', [
            'posts' => $posts,
        ]);
    }

    public function detailPost(Request $request, $id, $slug)
    {
        $detailPost = $this->post->find($id);
        if (!$detailPost) {
            return redirect()->route('admin.home.index');
        }

        $previousId         = $this->post->where('id', '<', $detailPost->id)->max('id');
        $detailPreviousPost = $this->post->find($previousId);

        $nextId         = $this->post->where('id', '>', $detailPost->id)->min('id');
        $detailNextPost = $this->post->find($nextId);

        return view('home.detail-post', [
            'post'               => $detailPost,
            'detailPreviousPost' => $detailPreviousPost,
            'detailNextPost'     => $detailNextPost,
        ]);
    }

    public function about()
    {
        return view('home.about', [

        ]);
    }
}
