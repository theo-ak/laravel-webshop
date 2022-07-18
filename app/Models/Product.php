<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Product extends Model
{
    use HasFactory;

    static function addToCart(Request $request)
    {
        $request->session()->push('cart', $request->input('id'));
    }

    static function removeFromCart(Request $request)
    {
        $cart = collect($request->session()->get('cart'));
        $cart->forget($cart->search($request->input('id')));

        $request->session()->put('cart', $cart->toArray());
    }

    static function notInCart(Request $request)
    {
        return collect(static::all())
            ->reject(function ($product) use ($request) {
                return in_array($product->id, $request->session()->get('cart'));
            });
    }

    static function inCart(Request $request)
    {
        return collect(static::all())
            ->filter(function ($product) use ($request) {
                return in_array($product->id, $request->session()->get('cart'));
            });
    }
}
