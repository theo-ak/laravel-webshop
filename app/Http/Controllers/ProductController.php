<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        return view('products', ['products' => Product::all()]);
    }

    public function create()
    {
        return view('product');
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

        return redirect()->route('products.edit', $product);
    }

    public function edit(Product $product)
    {
        return view('product', ['product' => $product]);
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
            Storage::delete($product->img);
            $attributes['img'] = $request->file('img')->store('thumbnails');
        }

        $product->update($attributes);

        return back();
    }

    public function destroy(Request $request)
    {
        Product::find($request->input('id'))->delete();
        Product::removeFromCart($request);

        return redirect()->route('products.index');
    }
}
