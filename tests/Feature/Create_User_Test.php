<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class Create_User_Test extends TestCase
{
    use RefreshDatabase;
    public function test_create_user(): void
    {
        $response = $this->postJson('/api/add-user', [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'username' => 'johndoe',
            'role' => 'admin',
            'password' => 'password123'
        ]);

        $response->assertStatus(200);

        $response->assertJson([
            'message' => 'User created successfully'
        ]);

        $this->assertDatabaseHas('users', [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'role' => 'admin'
        ]);
    }
}
