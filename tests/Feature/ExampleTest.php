<?php

it('testAPI endpoint returns successful response', function () {
    $response = $this->getJson('/api/testAPI');

    $response->assertStatus(200)
        ->assertJson([
            'server' => 'API Server is working...'
        ]);
});
