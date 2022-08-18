<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();

        return response()->json([
            'products' => $products
        ]);
    }

    public function create(Request $request)
    {
        return view('product', ['request' => $request]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages()
            ]);
        } else {
            $product = Product::create($validator->validated());

            return response()->json([
               'status' => 200,
               'message' => 'Product added successfully',
               'product' => $product
            ]);
        }
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

        $attributes['img'] = $request->file('img')->store('thumbnails');

        $product->update($attributes);

        return back();
    }

    public function destroy(Request $request, $id)
    {
        Product::find($id)->delete();
        Product::removeFromCart($request);

        return response()->json([
            'status' => 200,
            'message' => 'Product deleted successfully'
        ]);
    }
}
