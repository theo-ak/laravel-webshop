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

Route::post('/products', function (Request $request) {
    Product::find($request->input('id'))->delete();
    Product::removeFromCart($request);

    return view('products', ['products' => Product::all()]);
});

Route::get('/product/edit/{product}', function (Product $product, Request $request) {
    return view('product', ['product' => $product, 'request' => $request]);
})->name('edit');

Route::post('/product/edit/{product}', function (Product $product, Request $request) {
    $product->title = $request->input('title');
    $product->description = $request->input('description');
    $product->price = $request->input('price');
    $product->save();

    return view('product', ['product' => $product, 'request' => $request]);
});

Route::get('/product/add', function (Request $request) {
    return view('product', ['product' => new Product, 'request' => $request]);
});

Route::post('/product/add', function (Product $product, Request $request) {
    $product->title = $request->input('title');
    $product->description = $request->input('description');
    $product->price = $request->input('price');
    $product->save();

    return redirect()->route('edit', ['product' => $product->id]);
});
