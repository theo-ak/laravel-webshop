<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
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

Route::get('/login', [LoginController::class, 'create'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'store'])->middleware('guest');

Route::get('/logout', [LoginController::class, 'destroy'])->middleware('auth');

Route::get('/', function (Request $request) {
    return view('index', ['products' => Product::notInCart($request)]);
});

Route::post('/', [CartController::class, 'store']);

Route::get('/cart', [CartController::class, 'index']);
Route::post('/cart', [CartController::class, 'destroy']);
Route::post('cart/checkout', [CartController::class, 'checkout']);

Route::get('/products', [ProductController::class, 'index'])->middleware('auth');
Route::post('/products', [ProductController::class, 'destroy'])->middleware('auth');

Route::get('/product/add', [ProductController::class, 'create'])->middleware('auth');
Route::post('/product/add', [ProductController::class, 'store'])->middleware('auth');

Route::get('/product/edit/{product}', [ProductController::class, 'edit'])->name('edit')->middleware('auth');
Route::post('/product/edit/{product}', [ProductController::class, 'update'])->middleware('auth');

Route::get('/orders', [OrderController::class, 'index'])->middleware('auth');
Route::get('/order/{order}', [OrderController::class, 'show'])->middleware('auth');


