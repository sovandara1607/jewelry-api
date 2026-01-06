<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Shop;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'product_name' => fake()->words(3, true),
            'product_category' => fake()->randomElement(['Electronics', 'Clothing', 'Food', 'Books', 'Toys']),
            'product_price' => fake()->randomFloat(2, 10, 1000),
            'product_description' => fake()->sentence(),
            'in_stock' => fake()->numberBetween(0, 100),
            'shop_id' => Shop::factory(),
        ];
    }
}
