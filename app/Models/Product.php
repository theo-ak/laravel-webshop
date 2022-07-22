<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $attributes = [
        'img' => 'image',
    ];

    public function orders()
    {
        return $this->belongsToMany(Order::class);
    }

    static function addToCart(Request $request)
    {
        $cart = collect($request->session()->get('cart'));
        $id = $request->input('id');

        if (!$cart->search($id) && is_numeric($id) && Product::find($id)) {
            $request->session()->push('cart', $id);
        }
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
