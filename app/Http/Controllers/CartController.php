<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        // Get the authenticated user's cart
        $cart = Cart::where('user_id', Auth::id())->with('products')->first();

        if ($cart) {
            return response()->json([
                'products' => $cart->products->map(function ($product) {
                    return [
                        'name' => $product->name,
                        'quantity' => $product->pivot->quantity,
                        'price' => $product->price,
                        'total' => $product->price * $product->pivot->quantity,
                    ];
                }),
                'total' => $cart->products->sum(function ($product) {
                    return $product->price * $product->pivot->quantity;
                }),
            ]);
        }

        return response()->json(['message' => 'Cart is empty'], 200);
    }
}

