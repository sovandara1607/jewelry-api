<?php

use App\Models\Product;
use App\Models\Shop;
use App\Models\User;

describe('Product API Endpoints', function () {

   it('can get all products', function () {
      // Create some test data
      $shop = Shop::factory()->create();
      Product::factory()->count(3)->create(['shop_id' => $shop->shop_id]);

      $response = $this->getJson('/api/getAllProductList');

      $response->assertStatus(200)
         ->assertJsonStructure([
            'product_list' => [
               '*' => [
                  'product_name',
                  'product_category',
                  'product_price',
                  'in_stock',
                  'shop_name',
               ]
            ]
         ]);
   });

   it('can search products', function () {
      $shop = Shop::factory()->create();
      Product::factory()->create([
         'product_name' => 'Laptop Computer',
         'shop_id' => $shop->shop_id
      ]);

      $response = $this->getJson('/api/productSearchList?search=Laptop');

      $response->assertStatus(200)
         ->assertJsonStructure([
            'product_Search'
         ]);
   });
});

describe('Shop API Endpoints', function () {

   it('can get all shops', function () {
      Shop::factory()->count(3)->create();

      $response = $this->getJson('/api/getAllShopList');

      $response->assertStatus(200)
         ->assertJsonStructure([
            'shop_list'
         ]);
   });
});

describe('User API Endpoints', function () {

   it('can get all users', function () {
      User::factory()->count(3)->create();

      $response = $this->getJson('/api/getAllUserList');

      $response->assertStatus(200)
         ->assertJsonStructure([
            'user_list'
         ]);
   });
});
