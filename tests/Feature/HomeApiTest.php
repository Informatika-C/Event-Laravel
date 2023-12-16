<?php

namespace Tests\Feature;

use App\Models\EventLomba;
use App\Models\Penyelenggara;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HomeApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_user_can_access_home_page(): void
    {
        $response = $this->get('/api/home');

        $response->assertStatus(200);
    }

    public function test_a_user_can_get_null_data_when_no_event(): void
    {
        $response = $this->get('/api/home');

        $response->assertStatus(200);

        $response->assertJson([
            'events' => [],
            'nerest_event' => null,
        ]);
    }

    public function test_a_user_can_get_five_last_event(): void
    {
        $penyelenggara_id = Penyelenggara::factory()->create();
        EventLomba::factory()->count(10)->create([
            'penyelenggara_id' => $penyelenggara_id,
        ]);

        $response = $this->get('/api/home');

        $response->assertStatus(200);

        $response->assertJsonCount(5, 'events');

        $response->assertJsonStructure([
            'events' => [
                '*' => [
                    'id',
                    'nama_event',
                    'tempat',
                    'tanggal_pendaftaran',
                    'tanggal_penutupan_pendaftaran',
                    'tanggal_pelaksanaan',
                    'banner',
                    'poster',
                    "penyelenggara" => [
                        "id",
                        "nama_penyelenggara",
                        "logo",
                        "no_telp",
                    ],
                ],
            ],
            'nerest_event' => [
                'id',
                'nama_event',
                'tempat',
                'tanggal_pendaftaran',
                'tanggal_penutupan_pendaftaran',
                'tanggal_pelaksanaan',
                'banner',
                'poster',
                "penyelenggara" => [
                    "id",
                    "nama_penyelenggara",
                    "logo",
                    "no_telp",
                ],
            ],
        ]);
    }
}
