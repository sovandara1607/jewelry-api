<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Run all seeders in order (respecting foreign key constraints)
        $this->call([
            UserSeeder::class,           // Must be first - shops depend on users
            AdminSeeder::class,          // Independent
            ShopSeeder::class,           // Depends on users
            UpdatedProductSeeder::class, // Depends on shops
            ProductImageSeeder::class,   // Depends on products
            OrderSeeder::class,          // Depends on users
            OrderItemSeeder::class,      // Depends on orders and products
        ]);
    }
}