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

Route::post('/login', [LoginController::class, 'store'])->name('login.store');

Route::get('/logout', [LoginController::class, 'destroy'])->name('logout')->middleware('auth');

Route::get('/', [HomepageController::class, 'index'])->name('index');
Route::get('/fetch-products', [HomepageController::class, 'fetchProducts']);

Route::post('/cart/{id}', [CartController::class, 'store']);

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::delete('/cart/{id}', [CartController::class, 'destroy'])->name('cart.destroy');
Route::post('/orders', [CartController::class, 'checkout'])->name('orders.store');

Route::get('/products', [ProductController::class, 'index'])->name('products.index')->middleware('auth');
Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy')->middleware('auth');

Route::post('/products', [ProductController::class, 'store'])->name('product.store')->middleware('auth');

Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('product.edit')->middleware('auth');
Route::put('/products/{id}', [ProductController::class, 'update'])->name('product.update')->middleware('auth');

Route::get('/orders', [OrderController::class, 'index'])->name('orders.index')->middleware('auth');
Route::get('orders/{id}', [OrderController::class, 'show'])->name('order.show')->middleware('auth');


