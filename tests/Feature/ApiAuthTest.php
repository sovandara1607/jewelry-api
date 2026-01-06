<?php

use App\Models\User;

describe('Basic API Tests', function () {

   it('testAPI endpoint works', function () {
      $response = $this->getJson('/api/testAPI');

      $response->assertStatus(200)
         ->assertJson([
            'server' => 'API Server is working...'
         ]);
   });

   it('user can get profile with sanctum authentication', function () {
      $user = User::factory()->create();

      $response = $this->actingAs($user, 'sanctum')
         ->getJson('/api/user/profile');

      $response->assertStatus(200)
         ->assertJson([
            'name' => $user->name,
            'email' => $user->email,
         ]);
   });

   it('cannot get user profile without authentication', function () {
      $response = $this->getJson('/api/user/profile');

      $response->assertStatus(401);
   });
});
