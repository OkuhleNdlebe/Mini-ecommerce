<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;



Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


// Inertia route for rendering the cart page
Route::get('/cart', [CartController::class, 'index'])->middleware('auth')->name('cart.index');

// API route for fetching cart data
Route::get('/api/cart', [CartController::class, 'show'])->middleware('auth')->name('api.cart.show');


Route::get('/products', [ProductController::class, 'index']);
// View cart
Route::get('/cart', [CartController::class, 'show'])->middleware('auth');

// Add product to cart
Route::post('/cart/add', [CartController::class, 'add'])->middleware('auth');

// Remove product from cart
Route::delete('/cart/remove/{product}', [CartController::class, 'remove'])->middleware('auth');

// Route::middleware('auth:sanctum')->get('/cart', [CartController::class, 'index']);
//Route::get('/cart', [CartController::class, 'index'])->middleware('auth')->name('cart.index');
