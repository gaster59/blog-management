<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RequestCategory;
use App\Models\Category;
use App\Models\User;
use App\Service\CommonService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function __construct(Category $category, User $user, CommonService $commonService)
    {
        $this->category      = $category;
        $this->user          = $user;
        $this->commonService = $commonService;
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
        $categories = $this->category->with('childCategory')->where('parent_id', null)->get();
        return response()->json([
            'status' => 1,
            'msg'    => 'success',
            'data'   => $categories,
        ]);
    }

    /**
     * @return json
     */
    public function doAdd(RequestCategory $request)
    {
        $resultToken = $this->commonService->checkUserToken($request, $this->user);
        if (0 == $resultToken['status']) {
            return $resultToken;
        }
        $this->category->title     = $request->title;
        $this->category->slug      = Str::slug(stripVN($request->title), '-');
        $this->category->content   = $request->content;
        $this->category->parent_id = $request->parent_id;
        $this->category->save();
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
            'data'   => $category
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
