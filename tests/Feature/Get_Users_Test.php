<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class Get_Users_Test extends TestCase
{
    use RefreshDatabase;
    public function test_get_users(): void
    {
        $users = User::factory()->count(3)->create();

        $response = $this->getJson('/api/users');

        $response->assertStatus(200);

        $response->assertJsonCount(3);

        $response->assertJsonStructure([
            '*' => [
                'id',
                'first_name',
                'last_name',
                'role'
            ]
        ]);
    }
}
