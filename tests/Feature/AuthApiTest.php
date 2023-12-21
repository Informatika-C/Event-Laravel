<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\Sanctum;
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

    public function test_a_user_cannot_register_with_invalid_details(): void
    {
        $response = $this->post('/api/register', [
            'name' => 'User',
            'email' => 'haha'
        ]);

        $response->assertStatus(422);

        $response->assertJsonStructure([
            'message',
            'errors' => [
                'email',
                'password',
                'npm',
                'phone'
            ]
        ]);
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

    public function test_a_user_can_logout(): void
    {
        $user = User::factory()->create([
            'name' => 'User',
            'email' => 'user@gmail.com',
            'password' => Hash::make('password')
        ]);
        Sanctum::actingAs($user);
        $this->assertAuthenticated('sanctum');

        $response = $this->post('/api/logout');

        $response->assertStatus(200);

        $response->assertJson([
            'message' => 'Logged out'
        ]);
    }

    public function test_a_user_can_get_user_details(): void
    {
        $user = User::factory()->create([
            'name' => 'User',
            'email' => 'user@gmail.com',
            'password' => Hash::make('password')
        ]);

        Sanctum::actingAs($user);

        $response = $this->get('/api/user');

        $response->assertStatus(200);

        $response->assertJsonStructure([
            'id',
            'name',
            'email',
            'npm',
            'phone',
            'created_at',
            'updated_at'
        ]);

        $response->assertJson([
            'name' => 'User',
            'email' => 'user@gmail.com'
        ]);
    }

    public function test_a_user_can_update_user_details(): void
    {
        $user = User::factory()->create([
            'name' => 'User',
            'email' => 'user@gmail.com',
            'password' => Hash::make('password'),
            'npm' => '1234567890',
            'phone' => '081234567890'
        ]);

        Sanctum::actingAs($user);

        $response = $this->post('/api/user', [
            'name' => 'User2',
            'email' => 'user2@gmail.com',
            'npm' => '0987654321',
            'phone' => '089876543210',
        ]);

        $response->assertStatus(200);

        $response->assertJsonStructure([
            'message',
            'user' => [
                'id',
                'name',
                'email',
                'npm',
                'phone',
                'created_at',
                'updated_at'
            ]
        ]);

        $response->assertJson([
            'message' => 'User updated',
            'user' => [
                'name' => 'User2',
                'email' => 'user2@gmail.com',
                'npm' => '0987654321',
                'phone' => '089876543210'
            ]
        ]);

        $userBaru = User::find($user->id);

        $this->assertEquals('User2', $userBaru->name);
        $this->assertEquals('user2@gmail.com', $userBaru->email);
        $this->assertEquals('0987654321', $userBaru->npm);
        $this->assertEquals('089876543210', $userBaru->phone);
    }

    public function test_user_chage_password(): void
    {
        $user = User::factory()->create([
            'name' => 'User',
            'email' => 'user@gmail.com',
            'password' => Hash::make('password'),
        ]);

        Sanctum::actingAs($user);

        $response = $this->post('/api/user', [
            'password' => 'password2',
            'password_confirmation' => 'password2'
        ]);

        $response->assertStatus(200);

        $this->assertTrue(Hash::check('password2', $user->fresh()->password));
    }

    public function test_fail_to_chage_email_to_existing_email(): void
    {
        $user = User::factory()->create([
            'name' => 'User',
            'email' => 'user@gmail.com',
        ]);

        $user2 = User::factory()->create([
            'name' => 'User2',
            'email' => 'user2@gmail.com'
        ]);

        Sanctum::actingAs($user);

        $response = $this->post('/api/user', [
            'email' => 'user2@gmail.com'
        ]);

        $response->assertStatus(422);

        $response->assertJsonStructure([
            'message',
            'errors' => [
                'email'
            ]
        ]);
    }

    public function test_user_change_photo_profile(): void
    {
        $user = User::factory()->create();

        Sanctum::actingAs($user);

        $image = UploadedFile::fake()->image('photo_profile.jpg')->size(1000);

        $response = $this->post('/api/user/photo-profile', [
            'photo_profile' => $image
        ]);

        $response->assertStatus(200);

        $response->assertJsonStructure([
            'message',
            'photo_profile'
        ]);

        $response->assertJson([
            'photo_profile' => $user->photo_profile
        ]);

        $this->assertFileExists(public_path($user->photo_profile));
    }

    public function test_user_change_photo_profile_with_invalid_file_type(): void
    {
        $user = User::factory()->create();

        Sanctum::actingAs($user);

        $image = UploadedFile::fake()->create('photo_profile.pdf')->size(1000);

        $response = $this->post('/api/user/photo-profile', [
            'photo_profile' => $image
        ]);

        $response->assertStatus(422);

        $response->assertJsonStructure([
            'message',
            'errors' => [
                'photo_profile'
            ]
        ]);
    }

    public function test_user_change_photo_profile_with_invalid_file_size(): void
    {
        $user = User::factory()->create();

        Sanctum::actingAs($user);

        $image = UploadedFile::fake()->image('photo_profile.jpg')->size(6000);

        $response = $this->post('/api/user/photo-profile', [
            'photo_profile' => $image
        ]);

        $response->assertStatus(422);

        $response->assertJsonStructure([
            'message',
            'errors' => [
                'photo_profile'
            ]
        ]);
    }

    public function test_user_change_photo_profile_without_file(): void
    {
        $user = User::factory()->create();

        Sanctum::actingAs($user);

        $response = $this->post('/api/user/photo-profile');

        $response->assertStatus(422);

        $response->assertJsonStructure([
            'message',
            'errors' => [
                'photo_profile'
            ]
        ]);
    }

    public function test_photo_are_deleted_when_new_photo_is_uploaded()
    {
        $user = User::factory()->create([
            'photo_profile' => 'photo-profile/photo_profile.jpg'
        ]);

        Sanctum::actingAs($user);

        $image = UploadedFile::fake()->image('photo_profile.jpg')->size(1000);

        $response = $this->post('/api/user/photo-profile', [
            'photo_profile' => $image
        ]);

        $response->assertStatus(200);

        $this->assertFileDoesNotExist(public_path('photo-profile/photo_profile.jpg'));
    }
}
