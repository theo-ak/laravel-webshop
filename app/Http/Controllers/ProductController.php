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
        $attributes = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'price' => 'required|numeric'
        ]);

        $product = Product::create($attributes);

        return response()->json([
           'status' => 200,
           'message' => __('labels.Product added successfully'),
           'product' => $product
        ]);
    }


    public function edit($id)
    {
        $product = Product::findOrFail($id);

        return response()->json([
            'status' => 200,
            'product' => $product
        ]);
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $attributes = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'price' => 'required|numeric'
        ]);


        $product->update($attributes);

        return response()->json([
            'status' => 200,
            'message' => __('labels.Product updated successfully'),
            'product' => $product
        ]);
    }

    public function destroy(Request $request, $id)
    {
        Product::find($id)->delete();
        Product::removeFromCart($request);

        return response()->json([
            'status' => 200,
            'message' => __('labels.Product deleted successfully')
        ]);
    }
}
