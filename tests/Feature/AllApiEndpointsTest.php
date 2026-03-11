<?php

use App\Models\Admin;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Shop;
use App\Models\User;

// ─── Test API Health ────────────────────────────────────────────────
describe('Test API Health', function () {

   it('returns API server status', function () {
      $response = $this->getJson('/api/testAPI');

      $response->assertStatus(200)
         ->assertJson(['server' => 'API Server is working...']);
   });
});

// ─── User Auth Endpoints ────────────────────────────────────────────
describe('User Auth API', function () {

   it('registers a new user', function () {
      $response = $this->postJson('/api/user/register', [
         'name' => 'Test User',
         'email' => 'testuser@example.com',
         'phonenumber' => '012345678',
         'password' => 'password123',
         'password_confirmation' => 'password123',
      ]);

      $response->assertStatus(201)
         ->assertJsonStructure(['message', 'token']);
   });

   it('fails registration with invalid data', function () {
      $response = $this->postJson('/api/user/register', [
         'name' => '',
         'email' => 'not-an-email',
      ]);

      $response->assertStatus(422)
         ->assertJsonStructure(['errors']);
   });

   it('fails registration with duplicate email', function () {
      User::factory()->create(['email' => 'duplicate@example.com']);

      $response = $this->postJson('/api/user/register', [
         'name' => 'Another User',
         'email' => 'duplicate@example.com',
         'phonenumber' => '012345678',
         'password' => 'password123',
         'password_confirmation' => 'password123',
      ]);

      $response->assertStatus(422);
   });

   it('logs in a user with valid credentials', function () {
      User::factory()->create([
         'email' => 'login@example.com',
         'password' => bcrypt('password123'),
      ]);

      $response = $this->postJson('/api/user/login', [
         'email' => 'login@example.com',
         'password' => 'password123',
      ]);

      $response->assertStatus(200)
         ->assertJsonStructure(['token']);
   });

   it('rejects login with invalid credentials', function () {
      User::factory()->create([
         'email' => 'user@example.com',
         'password' => bcrypt('password123'),
      ]);

      $response = $this->postJson('/api/user/login', [
         'email' => 'user@example.com',
         'password' => 'wrongpassword',
      ]);

      $response->assertStatus(400);
   });

   it('gets user profile when authenticated', function () {
      $user = User::factory()->create();

      $response = $this->actingAs($user, 'sanctum')
         ->getJson('/api/user/profile');

      $response->assertStatus(200)
         ->assertJsonStructure(['name', 'email']);
   });

   it('rejects profile access when unauthenticated', function () {
      $response = $this->getJson('/api/user/profile');

      $response->assertStatus(401);
   });

   it('logs out an authenticated user', function () {
      $user = User::factory()->create();
      $token = $user->createToken('test-token')->plainTextToken;

      $response = $this->withHeaders([
         'Authorization' => "Bearer $token",
      ])->postJson('/api/user/logout');

      $response->assertStatus(200)
         ->assertJson(['message' => 'Logged out successfully.']);
   });
});

// ─── Admin Auth Endpoints ───────────────────────────────────────────
describe('Admin Auth API', function () {

   it('registers a new admin', function () {
      $response = $this->postJson('/api/admin/register', [
         'admin_username' => 'AdminUser',
         'admin_email' => 'admin@example.com',
         'password' => 'password123',
         'password_confirmation' => 'password123',
      ]);

      $response->assertStatus(201)
         ->assertJsonStructure(['message', 'token', 'admin']);
   });

   it('fails admin registration with invalid data', function () {
      $response = $this->postJson('/api/admin/register', [
         'admin_username' => '',
         'admin_email' => 'not-email',
      ]);

      $response->assertStatus(422);
   });

   it('logs in an admin with valid credentials', function () {
      Admin::factory()->create([
         'admin_email' => 'admin_login@example.com',
         'password' => bcrypt('password123'),
      ]);

      $response = $this->postJson('/api/admin/login', [
         'admin_email' => 'admin_login@example.com',
         'password' => 'password123',
      ]);

      $response->assertStatus(200)
         ->assertJsonStructure(['token']);
   });

   it('rejects admin login with wrong password', function () {
      Admin::factory()->create([
         'admin_email' => 'admin2@example.com',
         'password' => bcrypt('rightpassword'),
      ]);

      $response = $this->postJson('/api/admin/login', [
         'admin_email' => 'admin2@example.com',
         'password' => 'wrongpassword',
      ]);

      $response->assertStatus(401);
   });

   it('gets admin dashboard when authenticated', function () {
      $admin = Admin::factory()->create();

      $response = $this->actingAs($admin, 'admin_api')
         ->getJson('/api/admin/dashboard');

      $response->assertStatus(200)
         ->assertJsonStructure(['admin']);
   });

   it('rejects admin dashboard without auth', function () {
      $response = $this->getJson('/api/admin/dashboard');

      $response->assertStatus(401);
   });

   it('logs out an authenticated admin', function () {
      $admin = Admin::factory()->create();
      $token = $admin->createToken('admin-token')->plainTextToken;

      $response = $this->withHeaders([
         'Authorization' => "Bearer $token",
      ])->postJson('/api/admin/logout');

      $response->assertStatus(200)
         ->assertJson(['message' => 'Admin logged out successfully.']);
   });
});

// ─── Product List Endpoints ─────────────────────────────────────────
describe('Product API Endpoints', function () {

   it('gets all product list', function () {
      $shop = Shop::factory()->create();
      Product::factory()->count(3)->create(['shop_id' => $shop->shop_id]);

      $response = $this->getJson('/api/getAllProductList');

      $response->assertStatus(200)
         ->assertJsonStructure(['product_list']);
   });

   it('searches products by keyword', function () {
      $shop = Shop::factory()->create();
      Product::factory()->create([
         'shop_id' => $shop->shop_id,
         'product_name' => 'Gold Necklace',
         'product_category' => 'Necklace',
      ]);

      $response = $this->getJson('/api/productSearchList?search=Gold');

      $response->assertStatus(200)
         ->assertJsonStructure(['product_Search']);
   });

   it('searches products with empty search returns all', function () {
      $shop = Shop::factory()->create();
      Product::factory()->count(2)->create(['shop_id' => $shop->shop_id]);

      $response = $this->getJson('/api/productSearchList?search=');

      $response->assertStatus(200)
         ->assertJsonStructure(['product_Search']);
   });

   it('filters products by category', function () {
      $shop = Shop::factory()->create();
      Product::factory()->create([
         'shop_id' => $shop->shop_id,
         'product_category' => 'Ring',
      ]);
      Product::factory()->create([
         'shop_id' => $shop->shop_id,
         'product_category' => 'Necklace',
      ]);

      $response = $this->getJson('/api/filterProductList?category=Ring');

      $response->assertStatus(200)
         ->assertJsonStructure(['category_Searched']);
   });

   it('filters products with All category', function () {
      $shop = Shop::factory()->create();
      Product::factory()->count(2)->create(['shop_id' => $shop->shop_id]);

      $response = $this->getJson('/api/filterProductList?category=All');

      $response->assertStatus(200)
         ->assertJsonStructure(['category_Searched']);
   });

   it('shows a single product by id', function () {
      $shop = Shop::factory()->create();
      $product = Product::factory()->create(['shop_id' => $shop->shop_id]);

      $response = $this->getJson("/api/product/{$product->product_id}");

      $response->assertStatus(200)
         ->assertJsonStructure(['product', 'seller']);
   });
});

// ─── Order List Endpoints ───────────────────────────────────────────
describe('Order API Endpoints', function () {

   it('gets all order list', function () {
      $user = User::factory()->create();
      Order::factory()->count(2)->create(['user_id' => $user->id]);

      $response = $this->getJson('/api/getAllOrderList');

      $response->assertStatus(200)
         ->assertJsonStructure(['order_list']);
   });

   it('searches orders by keyword', function () {
      $user = User::factory()->create();
      Order::factory()->create([
         'user_id' => $user->id,
         'delivery_address' => 'Phnom Penh',
      ]);

      $response = $this->getJson('/api/orderSearchList?search=Phnom');

      $response->assertStatus(200)
         ->assertJsonStructure(['order_Searched']);
   });

   it('filters orders by status', function () {
      $user = User::factory()->create();
      Order::factory()->create(['user_id' => $user->id, 'status' => 'pending']);
      Order::factory()->create(['user_id' => $user->id, 'status' => 'delivered']);

      $response = $this->getJson('/api/filterOrderList?status=pending');

      $response->assertStatus(200)
         ->assertJsonStructure(['status_Searched']);
   });

   it('filters orders with All status', function () {
      $user = User::factory()->create();
      Order::factory()->count(2)->create(['user_id' => $user->id]);

      $response = $this->getJson('/api/filterOrderList?status=All');

      $response->assertStatus(200)
         ->assertJsonStructure(['status_Searched']);
   });

   it('views order items list', function () {
      $user = User::factory()->create();
      $shop = Shop::factory()->create();
      $product = Product::factory()->create(['shop_id' => $shop->shop_id]);
      $order = Order::factory()->create(['user_id' => $user->id]);
      OrderItem::factory()->create([
         'order_id' => $order->order_id,
         'product_id' => $product->product_id,
      ]);

      $response = $this->getJson("/api/ViewOrderItemsList?oID={$order->order_id}");

      $response->assertStatus(200);
   });
});

// ─── Shop List Endpoints ────────────────────────────────────────────
describe('Shop API Endpoints', function () {

   it('gets all shop list', function () {
      Shop::factory()->count(2)->create();

      $response = $this->getJson('/api/getAllShopList');

      $response->assertStatus(200)
         ->assertJsonStructure(['shop_list']);
   });

   it('searches shops by name', function () {
      Shop::factory()->create(['shop_name' => 'Diamond Palace']);

      $response = $this->getJson('/api/shopSearchList?search=Diamond');

      $response->assertStatus(200)
         ->assertJsonStructure(['shop_Searched']);
   });

   it('filters shops by name', function () {
      Shop::factory()->create(['shop_name' => 'Alpha Jewelers']);
      Shop::factory()->create(['shop_name' => 'Beta Gems']);

      $response = $this->getJson('/api/filterShopList?Sname=Alpha');

      $response->assertStatus(200)
         ->assertJsonStructure(['sname_Searched']);
   });

   it('filters shops with All name', function () {
      Shop::factory()->count(2)->create();

      $response = $this->getJson('/api/filterShopList?Sname=All');

      $response->assertStatus(200)
         ->assertJsonStructure(['sname_Searched']);
   });
});

// ─── User List Endpoints ────────────────────────────────────────────
describe('User List API Endpoints', function () {

   it('gets all user list', function () {
      User::factory()->count(3)->create();

      $response = $this->getJson('/api/getAllUserList');

      $response->assertStatus(200)
         ->assertJsonStructure(['user_list']);
   });

   it('searches users by name', function () {
      User::factory()->create(['name' => 'Sopheak']);

      $response = $this->getJson('/api/userSearchList?search=Sopheak');

      $response->assertStatus(200)
         ->assertJsonStructure(['user_Searched']);
   });

   it('filters users by name', function () {
      User::factory()->create(['name' => 'Arun']);
      User::factory()->create(['name' => 'Bora']);

      $response = $this->getJson('/api/filterUserList?name=Arun');

      $response->assertStatus(200)
         ->assertJsonStructure(['name_Searched']);
   });

   it('filters users with All name', function () {
      User::factory()->count(2)->create();

      $response = $this->getJson('/api/filterUserList?name=All');

      $response->assertStatus(200)
         ->assertJsonStructure(['name_Searched']);
   });
});

// ─── Cart Endpoint ──────────────────────────────────────────────────
describe('Cart API Endpoint', function () {

   it('returns empty cart when no items in session', function () {
      $response = $this->getJson('/api/cart');

      $response->assertStatus(200)
         ->assertJson([
            'cartItemsByShop' => [],
            'totalAmount' => 0,
         ]);
   });
});

// ─── Protected Product Endpoints ────────────────────────────────────
describe('Protected Product API Endpoints', function () {

   it('rejects store product without authentication', function () {
      $response = $this->postJson('/api/product', [
         'product_name' => 'Test Ring',
         'product_category' => 'Ring',
         'product_price' => 100.00,
      ]);

      $response->assertStatus(401);
   });

   it('rejects edit product without authentication', function () {
      $shop = Shop::factory()->create();
      $product = Product::factory()->create(['shop_id' => $shop->shop_id]);

      $response = $this->getJson("/api/product/{$product->product_id}/edit");

      $response->assertStatus(401);
   });
});
