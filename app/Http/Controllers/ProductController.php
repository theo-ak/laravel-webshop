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
        return view('product', ['product' => new Product, 'request' => $request]);
    }

    public function store(Product $product, Request $request)
    {
        $product->title = $request->input('title');
        $product->description = $request->input('description');
        $product->price = $request->input('price');
        $product->save();

        return redirect()->action([ProductController::class, 'edit'], ['product' => $product, 'request' => $request]);
    }

    public function edit(Product $product, Request $request)
    {
        return view('product', ['product' => $product, 'request' => $request]);
    }

    public function update(Product $product, Request $request)
    {
        $product->title = $request->input('title');
        $product->description = $request->input('description');
        $product->price = $request->input('price');
        $product->save();

        return back();
    }

    public function destroy(Request $request)
    {
        Product::find($request->input('id'))->delete();
        Product::removeFromCart($request);

        return redirect('/products');
    }
}
