<?php

namespace App\Http\Controllers;

use App\Mail\OrderDetails;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
//    public function index()
//    {
//        return view('cart');
//    }

    public function index(Request $request)
    {
        $products = Product::inCart($request);

        return response()->json([
            'products' => $products
        ]);
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

    public function destroy(Request $request, $id)
    {
        $cart = collect($request->session()->get('cart'));

        $cart->forget($cart->search($id));

        $request->session()->put('cart', $cart->toArray());

        return response()->json([
            'status' => 200
        ]);
    }

    public function checkout(Request $request)
    {
        $products = Product::inCart($request);

        if ($products->isEmpty()) {
            return back()
                ->withInput()
                ->withErrors(['cart' => 'The cart is empty.']);
        }

        $attributes = $request->validate([
            'name' => 'required',
            'contact' => 'required'
        ]);

        $order = Order::create($attributes);

        foreach ($products as $product) {
            $order
                ->products()
                ->attach($product->id, ['product_price' => $product->price]);
        }

        $order->total = $order->products->sum('price');
        $order->save();

        Mail::to('shop-admin@shop.com')->send(new OrderDetails($order));

        $request->session()->put('cart', []);

        return response()->json([
           'status' => 200,
           'message' => __('labels.Order placed successfully')
        ]);
    }
}
