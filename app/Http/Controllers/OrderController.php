<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        return view('orders', ['orders' => Order::all()]);
    }

    public function show(Order $order)
    {
        return view('order', ['order' => $order]);
    }
}
