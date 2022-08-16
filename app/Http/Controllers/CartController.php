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
        return view('cart', ['products' => Product::inCart($request)]);
    }

    public function store(Request $request, $id)
    {
        $cart = collect($request->session()->get('cart'));

        if (!$cart->search($id) && Product::findOrFail($id)) {
            $request->session()->push('cart', $id);
        }

        return response()->json([
            'status' => 200
        ]);
    }

    public function destroy(Request $request)
    {
        $cart = collect($request->session()->get('cart'));

        $id = $request->validate([
            'id' => 'required|numeric'
        ])['id'];

        $cart->forget($cart->search($id));

        $request->session()->put('cart', $cart->toArray());

        return redirect()->route('cart.index');
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
