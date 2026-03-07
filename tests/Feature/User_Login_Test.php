<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Hash;

class User_Login_Test extends TestCase
{
    /**
     * A basic feature test example.
     */
    use RefreshDatabase, WithFaker;
    public function test_example(): void
    {
        $user = User::factory()->create([
            "username" => "testuser",
            "password" => Hash::make('testuser')
        ]);

        $response = $this->postJson('/api/login', [
            'username'=> 'testuser',
            'password'=> 'testuser'
        ]);

        $response->assertOk();
        $response->assertStatus(200);
    }
}
