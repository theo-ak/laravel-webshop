<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomepageController extends Controller
{
    public function index(Request $request)
    {
        return view('index');
    }

    public function fetchProducts(Request $request)
    {
        $products = Product::notInCart($request);

        return response()->json([
            'products' => $products
        ]);

//        return view('index', ['products' => Product::notInCart($request)]);
    }
}
