<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RequestCategory;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    /**
     * @return view
     */
    public function index()
    {
        $categories = $this->category->with('childCategory')->where('parent_id', null)->get();
        return view('admin.category.index', [
            'categories' => $categories,
        ]);
    }

    /**
     * @return view
     */
    public function add()
    {
        $categories = $this->category->where('parent_id', null)->get();
        return view('admin.category.add', [
            'categories' => $categories,
        ]);
    }

    /**
     * @param RequestCategory $request
     *
     * @return redirect
     */
    public function doAdd(RequestCategory $request)
    {
        $this->category->title     = $request->title;
        $this->category->slug      = Str::slug(stripVN($request->title), '-');
        $this->category->content   = $request->content;
        $this->category->parent_id = $request->parent_id;
        $this->category->save();
        return redirect()->route('admin.category.index');
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
            return redirect()->route('admin.category.index');
        }
        $categories = $this->category->where('parent_id', null)->get();
        return view('admin.category.edit', [
            'category'   => $category,
            'categories' => $categories,
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
            return redirect()->route('admin.category.index');
        }
        $category->title     = $request->title;
        $category->slug      = Str::slug(stripVN($request->title), '-');
        $category->content   = $request->content;
        $category->parent_id = $request->parent_id;
        $category->save();
        return redirect()->route('admin.category.index');
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
            return redirect()->route('admin.category.index');
        }
        $category->delete();
        return redirect()->route('admin.category.index');
    }
}
