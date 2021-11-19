<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RequestGenre;
use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class GenreController extends Controller
{
    public function __construct(Genre $genre)
    {
        $this->genre = $genre;
    }

    /**
     * @return view
     */
    public function index()
    {
        $genres = $this->genre->get();
        return view('admin.genre.index', [
            'genres' => $genres,
        ]);
    }

    /**
     * @return view
     */
    public function add()
    {
        return view('admin.genre.add');
    }

    /**
     * @param RequestGenre $request
     *
     * @return redirect
     */
    public function doAdd(RequestGenre $request)
    {
        $this->genre->name             = $request->name;
        $this->genre->slug             = Str::slug(stripVN($request->name), '-');
        $this->genre->description      = $request->description;
        $this->genre->meta_description = $request->meta_description;
        $this->genre->meta_keyword     = $request->meta_keyword;
        $this->genre->save();
        return redirect()->route('admin.genre.index');
    }

    /**
     * @param integer $id
     *
     * @return view
     */
    public function edit($id)
    {
        $genre = $this->genre->find($id);
        if (!$genre) {
            return redirect()->route('admin.genre.index');
        }
        return view('admin.genre.edit', [
            'genre' => $genre,
        ]);
    }

    /**
     * @param RequestGenre $request
     *
     * @return redirect
     */
    public function doEdit(RequestGenre $request, $id)
    {
        $genre = $this->genre->find($id);
        if (!$genre) {
            return redirect()->route('admin.genre.index');
        }
        $genre->name             = $request->name;
        $genre->slug             = Str::slug(stripVN($request->name), '-');
        $genre->description      = $request->description;
        $genre->meta_description = $request->meta_description;
        $genre->meta_keyword     = $request->meta_keyword;
        $genre->save();
        return redirect()->route('admin.genre.index');
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
            return redirect()->route('admin.category.index');
        }
        $category->delete();
        return redirect()->route('admin.category.index');
    }
}
