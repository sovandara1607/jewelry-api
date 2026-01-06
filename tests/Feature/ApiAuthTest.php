<?php

use App\Models\User;
use App\Models\Admin;

describe('User API Authentication', function () {

   it('can register a new user', function () {
      $response = $this->postJson('/api/user/register', [
         'name' => 'Test User',
         'email' => 'test@example.com',
         'password' => 'password123',
         'password_confirmation' => 'password123',
      ]);

      $response->assertStatus(201);
      $this->assertDatabaseHas('users', [
         'email' => 'test@example.com',
      ]);
   });

   it('can login a user', function () {
      $user = User::factory()->create([
         'email' => 'test@example.com',
         'password' => bcrypt('password'),
      ]);

      $response = $this->postJson('/api/user/login', [
         'email' => 'test@example.com',
         'password' => 'password',
      ]);

      $response->assertStatus(200);
   });

   it('can get user profile with authentication', function () {
      $user = User::factory()->create();

      $response = $this->actingAs($user, 'sanctum')
         ->getJson('/api/user/profile');

      $response->assertStatus(200);
   });

   it('cannot get user profile without authentication', function () {
      $response = $this->getJson('/api/user/profile');

      $response->assertStatus(401);
   });

   it('can logout a user', function () {
      $user = User::factory()->create();

      $response = $this->actingAs($user, 'sanctum')
         ->postJson('/api/user/logout');

      $response->assertStatus(200);
   });
});

describe('Admin API Authentication', function () {

   it('can register a new admin', function () {
      $response = $this->postJson('/api/admin/register', [
         'name' => 'Test Admin',
         'email' => 'admin@example.com',
         'password' => 'password123',
         'password_confirmation' => 'password123',
      ]);

      $response->assertStatus(201);
      $this->assertDatabaseHas('admin', [
         'email' => 'admin@example.com',
      ]);
   });

   it('can login an admin', function () {
      $admin = Admin::factory()->create([
         'email' => 'admin@example.com',
         'password' => bcrypt('password'),
      ]);

      $response = $this->postJson('/api/admin/login', [
         'email' => 'admin@example.com',
         'password' => 'password',
      ]);

      $response->assertStatus(200);
   });
});
