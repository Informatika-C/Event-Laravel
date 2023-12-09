<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthApiTest extends TestCase
{
    use RefreshDatabase;

    private function createUser(): void
    {
        User::factory()->create([
            'name' => 'User',
            'email' => 'user@gmail.com',
            'password' => 'password',
            'npm' => '1234567890',
            'phone' => '081234567890'
        ]);
    }
    
    public function test_a_user_can_register(): void
    {
        $response = $this->post('/api/register', [
            'name' => 'User',
            'email' => 'user@gmail.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'npm' => '1234567890',
            'phone' => '081234567890'
        ]);

        $response->assertStatus(201);
        $response->assertJsonStructure(['token', 'user']);
    }

    public function test_a_user_can_login(): void
    {
        $this->createUser();

        $response = $this->post('/api/login', [
            'email' => 'user@gmail.com',
            'password' => 'password',
        ]);

        $response->assertStatus(201);
        $response->assertJsonStructure(['token', 'user']);
    }

    public function test_a_user_cannot_login_with_invalid_details(): void
    {
        $this->createUser();

        $response = $this->post('/api/login', [
            'email' => 'user2@gmail.com',
            'password' => 'password',
        ]);

        $response->assertStatus(401);
        $response->assertJson([
            'message' => 'Invalid login details'
        ]);
    }
}
