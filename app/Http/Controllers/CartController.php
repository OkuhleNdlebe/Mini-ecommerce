<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;


class CartController extends Controller
{


public function index()
{
    // Render the Inertia page with no cart data (just the structure)
    return Inertia::render('CartPage');
}
    // Show the cart contents
    public function show()
    {
        $cart = Cart::with('products')->where('user_id', auth()->id())->firstOrFail();

        $cartItems = $cart->products->map(function ($product) {
            return [
                'id' => $product->id,
                'name' => $product->name,
                'quantity' => $product->pivot->quantity,
                'price' => $product->price,
                'total' => $product->price * $product->pivot->quantity,
            ];
        });

        $totalCost = $cartItems->sum('total');

        // Return JSON response for cart data
        return response()->json([
            'items' => $cartItems,
            'totalCost' => $totalCost,
        ]);
    }

    // Add a product to the cart
    public function add(Request $request)
    {
        $cart = Cart::firstOrCreate(['user_id' => Auth::id()]);

        $product = Product::findOrFail($request->input('product_id'));

        $cart->products()->syncWithoutDetaching([
            $product->id => ['quantity' => $request->input('quantity', 1)]
        ]);

        return response()->json([
            'message' => 'Product added to cart successfully!'
        ]);
    }

    // Remove a product from the cart
    public function remove($productId)
    {
        $cart = Cart::where('user_id', Auth::id())->firstOrFail();
        
        $cart->products()->detach($productId);

        return response()->json([
            'message' => 'Product removed from cart successfully!'
        ]);
    }
}
