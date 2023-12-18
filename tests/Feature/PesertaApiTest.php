<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PesertaApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_search_peserta()
    {
        $user1 = \App\Models\User::factory()->create([
            'name' => 'User 1',
        ]);

        $user2 = \App\Models\User::factory()->create([
            'name' => 'User 2',
        ]);

        $user3 = \App\Models\User::factory()->create([
            'name' => 'Orang',
        ]);

        $response = $this->get('/api/peserta/search?q=user');

        $response->assertStatus(200);

        $response->assertJson([
            [
                'id' => $user1->id,
                'name' => $user1->name,
            ],
            [
                'id' => $user2->id,
                'name' => $user2->name,
            ],
        ]);
    }

    public function test_search_peserta_with_no_query()
    {
        $user1 = \App\Models\User::factory()->create([
            'name' => 'User 1',
        ]);

        $response = $this->get('/api/peserta/search?q=');

        $response->assertStatus(200);

        $response->assertJson([]);
    }
}
