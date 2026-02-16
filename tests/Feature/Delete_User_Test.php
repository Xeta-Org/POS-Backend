<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class Delete_User_Test extends TestCase
{
    use RefreshDatabase;
    public function test_delete_user(): void
    {
        $user = User::factory()->create();

        $response = $this->deleteJson("/api/user/{$user->id}");

        $response->assertStatus(200);

        $this->assertDatabaseMissing("users", [
            "id" => $user->id
        ]);

        $response->assertJson([
            "message" => "User deleted successfully"
        ]);
    }
}
