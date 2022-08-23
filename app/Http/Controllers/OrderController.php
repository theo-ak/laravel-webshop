<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('products')->get();

        return response()->json([
           'status' => 200,
           'orders' => $orders
        ]);
    }

    public function show($id)
    {
        $order = Order::findOrFail($id);

        return response()->json([
            'status' => 200,
            'orders' => $order,
            'orderProducts' => $order->products
        ]);
    }
}
