<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;

// Home route
Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

// Dashboard route
Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Authenticated routes
Route::middleware('auth')->group(function () {
    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Cart page rendering using Inertia
    Route::get('/cart', function () {
        return Inertia::render('CartPage'); // Render CartPage Vue component via Inertia
    })->name('cart.index');
});

// Product API routes
Route::get('/products', [ProductController::class, 'index'])->name('products.index');

// Wow this took me 3 hours to figure it out 
// Cart API routes for AJAX calls from Vue frontend
Route::middleware('auth')->group(function () {
    Route::get('/api/cart', [CartController::class, 'show'])->name('api.cart.show');    // Fetch cart contents
    Route::post('/api/cart/add', [CartController::class, 'add'])->name('api.cart.add'); // Add product to cart
    Route::delete('/api/cart/remove/{product}', [CartController::class, 'remove'])->name('api.cart.remove'); // Remove product from cart
});

// Authentication routes
require __DIR__.'/auth.php';
