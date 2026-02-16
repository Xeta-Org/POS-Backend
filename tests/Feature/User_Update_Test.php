<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class User_Update_Test extends TestCase
{
    use RefreshDatabase;
    public function test_update_user(): void
    {
        $user = User::factory()->create();

        $response = $this->putJson("/api/user/{$user->id}", [
            "first_name" => "Test",
            "last_name" => "User",
            "role" => "cashier",
            "password" => "password",
        ]);

        $response->assertStatus(200);

        $response->assertJson([
            "message" => "User updated successfully",
        ]);

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'first_name' => "Test",
            'last_name' => "User",
            'role' => "cashier",
        ]);
    }
}
