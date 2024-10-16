<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
// use App\Http\Controllers\CartController;



Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/products', [ProductController::class, 'index']);
// Route::middleware('auth:sanctum')->get('/cart', [CartController::class, 'index']);
//Route::get('/cart', [CartController::class, 'index'])->middleware('auth')->name('cart.index');
