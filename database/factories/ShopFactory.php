<?php

namespace Database\Factories;

use App\Models\Shop;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Shop>
 */
class ShopFactory extends Factory
{
    protected $model = Shop::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'shop_name' => fake()->company(),
            'shop_email' => fake()->unique()->companyEmail(),
            'shop_phonenumber' => fake()->phoneNumber(),
            'shop_address' => fake()->address(),
            'shop_description' => fake()->sentence(),
            'shop_profilepic' => null,
        ];
    }
}
