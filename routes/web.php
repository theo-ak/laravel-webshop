<?php

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function (Request $request) {
    return view('index', ['products' => Product::notInCart($request)]);
});

Route::post('/', function (Request $request) {
    Product::addToCart($request);

    return view('index', ['products' => Product::notInCart($request)]);
});

Route::get('/cart', function (Request $request) {
    return view('cart', ['products' => Product::inCart($request)]);
});

Route::post('/cart', function (Request $request) {
    Product::removeFromCart($request);

    return view('cart', ['products' => Product::inCart($request)]);
});

Route::get('/products', function () {
    return view('products', ['products' => Product::all()]);
});

Route::get('/product/{product}', function (Product $product) {
    return view('product', ['product' => $product]);
});
