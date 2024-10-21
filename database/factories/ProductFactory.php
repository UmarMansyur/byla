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
    public function definition(): array
    {
        return [
            'merchant_id' => 1,
            'kode_produk' => fake()->unique()->numerify('PRD-#####'),
            'title' => fake()->sentence(),
            'price' => fake()->numberBetween(10000, 100000),
            'sale_price' => fake()->numberBetween(10000, 100000),
            'thumbnail' => "https://ik.imagekit.io/8zmr0xxik/auth.svg?updatedAt=1726630387421",
            'description' => fake()->paragraph(),
        ];
    }
}
