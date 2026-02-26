<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class User_update_with_same_username_Test extends TestCase
{
    /**
     * A basic feature test example.
     */
    use RefreshDatabase;
    public function test_user_with_same_username(): void
    {
        $user = User::factory()->create();

        $response = $this->putJson("/api/user/{$user->id}", [
            "first_name" => "Test",
            "last_name" => "User",
            "username" => $user->username,
            "role" => "cashier",
            "password" => "password",
            'status' => "Active",   
        ]);

        $response->assertStatus(200);

        $response->assertJson([
            "message" => "User updated successfully",
        ]);

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'first_name' => "Test",
            'last_name' => "User",
            "username"=> $user->username,
            'role' => "cashier",
        ]);
    }
}
