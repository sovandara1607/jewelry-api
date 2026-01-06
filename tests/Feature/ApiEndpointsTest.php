<?php

// Simple tests to verify the test API endpoint works
describe('API Status Check', function () {

   it('API server is responsive', function () {
      $response = $this->getJson('/api/testAPI');

      $response->assertStatus(200)
         ->assertJson([
            'server' => 'API Server is working...'
         ]);
   });
});
