<?php

namespace App\Http\Controllers;

use App\Mail\OrderDetails;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class CartController extends Controller
{
    public function index(Request $request)
    {
//        dd($request->session()->all());
        return view('cart', ['products' => Product::inCart($request)]);
    }

    public function add(Request $request)
    {
        $cart = collect($request->session()->get('cart'));
        $id = $request->input('id');

        if (!$cart->search($id) && is_numeric($id) && Product::find($id)) {
            $request->session()->push('cart', $id);
        }

        return redirect('/');
    }

    public function remove(Request $request)
    {
        $cart = collect($request->session()->get('cart'));
        $cart->forget($cart->search($request->input('id')));

        $request->session()->put('cart', $cart->toArray());

        return redirect('/cart');
    }

    public function checkout(Request $request)
    {
        $products = Product::inCart($request);

        if (!$products->isEmpty()) {
            $attributes = $request->validate([
                'name' => 'required',
                'contact' => 'required'
            ]);

            $order = Order::create($attributes);

            foreach ($products as $product) {
                $order_product = new OrderProduct;

                $order_product->order_id = $order->id;
                $order_product->product_id = $product->id;
                $order_product->product_price = $product->price;

                $order_product->save();
            }

            Mail::to('shop-admin@shop.com')->send(new OrderDetails($order));

            $request->session()->put('cart', []);
            return view('cart', ['products' => Product::inCart($request), 'order' => $order]);
        }

        return back()
            ->withInput()
            ->withErrors(['cart' => 'The cart is empty.']);
    }
}
