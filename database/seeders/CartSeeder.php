<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Cart;
use App\Models\User;
use App\Models\Product;




class CartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $users = User::all(); // Get all users
        $products = Product::all(); // Get all products

        // For each user, create a cart and add products
        $users->each(function ($user) use ($products) {
            $cart = Cart::create([
                'user_id' => $user->id, // Assign the cart to a user
            ]);

            $cart->products()->attach(
                $products->random(3), // Add 3 random products
                ['quantity' => rand(1, 5)] // Random quantity for each product
            );
        });
    }
}
