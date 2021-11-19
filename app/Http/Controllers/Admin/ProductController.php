<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RequestProduct;
use App\Models\Genre;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function __construct(Product $product, Genre $genre)
    {
        $this->product = $product;
        $this->genre   = $genre;
    }

    /**
     * @return view
     */
    public function index()
    {
        $products = $this->product->simplePaginate(config('constants.paging_admin'));
        return view('admin.product.index', [
            'products' => $products,
        ]);
    }

    /**
     * @return view
     */
    public function add()
    {
        $genres = $this->genre->get();
        return view('admin.product.add', [
            'genres' => $genres,
        ]);
    }

    /**
     * @param RequestProduct $request
     *
     * @return redirect
     */
    public function doAdd(RequestProduct $request)
    {
        $name                            = $request->input('name', '');
        $slug                            = Str::slug(stripVN($name), '-');
        $avatar                          = uploadImage($request, $folder = 'product', $control = 'avatar', $suffix = 'product_');
        $authorId                        = Auth::guard('admin')->user()->id;
        $this->product->name             = $name;
        $this->product->slug             = $slug;
        $this->product->description      = $request->input('description', '');
        $this->product->summary          = $request->input('summary', '');
        $this->product->avatar           = $avatar;
        $this->product->genre_id         = $request->input('genre_id', '');
        $this->product->price            = $request->input('price', '');
        $this->product->meta_description = $request->input('meta_description', '');
        $this->product->meta_keyword     = $request->input('meta_keyword', '');
        $this->product->created_by       = $authorId;
        $this->product->save();
        return redirect()->route('admin.product.add')->with('success', 'Insert success');
    }

}
