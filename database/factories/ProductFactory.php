<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word(),
            'description' => $this->faker->sentence(),
            'price' => $this->faker->randomFloat(2, 10, 200), // Random price between 10 and 200
            'quantity' => $this->faker->numberBetween(1, 100), // Random quantity
            'image' => $this->faker->imageUrl(640, 480, 'product', true), // Random image URL
        ];
    }
}
