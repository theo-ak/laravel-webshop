<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return view('products', ['products' => Product::all()]);
    }

    public function create(Request $request)
    {
        return view('product', ['request' => $request]);
    }

    public function store(Request $request)
    {
        $attributes = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'img' => 'image'
        ]);

        $attributes['img'] = $request->file('img')->store('thumbnails');

        $product = Product::create($attributes);

        return redirect()->action([ProductController::class, 'edit'], ['product' => $product, 'request' => $request]);
    }

    public function edit(Product $product, Request $request)
    {
        return view('product', ['product' => $product, 'request' => $request]);
    }

    public function update(Product $product, Request $request)
    {
        $attributes = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'img' => 'image'
        ]);

        if (isset($attributes['img'])) {
            $attributes['img'] = $request->file('img')->store('thumbnails');
        }

        $product->update($attributes);

        return back();
    }

    public function destroy(Request $request)
    {
        Product::find($request->input('id'))->delete();
        Product::removeFromCart($request);

        return redirect('/products');
    }
}
