<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
use App\Mail\OrderDetails;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
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

Route::get('/products', [ProductController::class, 'index'])->middleware('auth');
Route::post('/products', [ProductController::class, 'destroy'])->middleware('auth');

Route::get('/product/add', [ProductController::class, 'create'])->middleware('auth');
Route::post('/product/add', [ProductController::class, 'store'])->middleware('auth');

Route::get('/product/edit/{product}', [ProductController::class, 'edit'])->name('edit')->middleware('auth');
Route::post('/product/edit/{product}', [ProductController::class, 'update'])->middleware('auth');

Route::post('cart/checkout', function (Request $request) {
    $products = Product::inCart($request);

    if (!$products->isEmpty()) {
        $order = new Order;

        $order->name = $request->input('name');
        $order->contact = $request->input('contact');
        $order->comments = $request->input('comments');
        $order->save();

        foreach ($products as $product) {
            $order_product = new OrderProduct;

            $order_product->order_id = $order->id;
            $order_product->product_id = $product->id;

            $order_product->save();
        }

        Mail::to('shop-admin@shop.com')->send(new OrderDetails($order));

        $request->session()->put('cart', []);
        return view('cart', ['products' => Product::inCart($request), 'order' => $order]);
    }

    return view('cart', ['products' => Product::inCart($request)]);
});

Route::get('/orders', function () {
    return view('orders', ['orders' => Order::all()]);
})->middleware('auth');

Route::get('/order/{order}', function (Order $order) {
    return view('order', ['order' => $order]);
})->middleware('auth');


