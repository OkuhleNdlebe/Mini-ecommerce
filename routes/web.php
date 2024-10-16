<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;




Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
     // Cart route, authenticated user will see their cart
    // Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
});
Route::get('/products', function () {
    return Inertia::render('ProductsPage');
})->name('products.index');


//Route::get('/cart', [CartController::class, 'index'])->middleware('auth')->name('cart.index');



//Route::get('/products', [ProductController::class, 'index'])->name('products.index');

require __DIR__.'/auth.php';
