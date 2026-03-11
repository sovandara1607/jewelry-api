<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        Product::create([
            'product_name' => 'Ronda Earrings',
            'product_category' => 'earrings',
            'product_price' => 135.00,
            'product_images' => '/images/earrings-ronda-silver.jpg',
            'shop_id' => 1,
        ]);

        Product::create([
            'product_name' => 'Ronda Bracelet',
            'product_category' => 'bracelet',
            'product_price' => 135.00,
            'product_images' => '/images/bracelet-ronda-silver.jpg',
            'shop_id' => 1,
        ]);
    }
}
