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
        return static::select()
            ->whereNotIn('id', $request->session()->get('cart'))->get();
    }

    static function inCart(Request $request)
    {
        return static::select()
            ->whereIn('id', $request->session()->get('cart'))->get();
    }
}
