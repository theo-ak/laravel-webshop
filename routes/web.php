<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\HomepageController;
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

//Route::get('/login', [LoginController::class, 'create'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'store'])->name('login.store');

Route::get('/logout', [LoginController::class, 'destroy'])->name('logout')->middleware('auth');

Route::get('/', [HomepageController::class, 'index'])->name('index');
Route::get('fetch-products', [HomepageController::class, 'fetchProducts']);

Route::post('add-to-cart/{id}', [CartController::class, 'store']);

//Route::post('/', [CartController::class, 'store'])->name('index.store');

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::get('/fetch-cart-products', [CartController::class, 'fetchCartProducts']);
//Route::post('/cart', [CartController::class, 'destroy'])->name('cart.destroy');
Route::post('/remove-from-cart/{id}', [CartController::class, 'destroy'])->name('cart.destroy');
//Route::post('cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
Route::post('/checkout', [CartController::class, 'checkout']);

Route::get('/fetch-all-products', [ProductController::class, 'index'])->name('products.index')->middleware('auth');
//Route::post('/products', [ProductController::class, 'destroy'])->name('products.destroy')->middleware('auth');
Route::post('/delete/{id}', [ProductController::class, 'destroy'])->name('products.destroy')->middleware('auth');

//Route::get('/product/add', [ProductController::class, 'create'])->name('product.create')->middleware('auth');
Route::post('/add', [ProductController::class, 'store'])->name('product.store')->middleware('auth');

Route::get('/product/edit/{product}', [ProductController::class, 'edit'])->name('product.edit')->middleware('auth');
Route::post('/product/edit/{product}', [ProductController::class, 'update'])->name('product.update')->middleware('auth');

Route::get('/orders', [OrderController::class, 'index'])->name('orders.index')->middleware('auth');
Route::get('/order/{order}', [OrderController::class, 'show'])->name('order.show')->middleware('auth');


