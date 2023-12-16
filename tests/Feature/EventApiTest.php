<?php

namespace Tests\Feature;

use App\Models\EventLomba;
use App\Models\Kategori;
use App\Models\KategoriLomba;
use App\Models\Lomba;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EventApiTest extends TestCase
{
    use RefreshDatabase;

    public function createKategori($nama_kategori): int
    {
        $kategori = Kategori::factory()->create(
            [
                'nama_kategori' => $nama_kategori,
            ]
        );
        return $kategori->id;
    }

    private function createEvent(): int
    {
        $event = EventLomba::factory()->create();
        return $event->id;
    }

    private function createLomba($event_id): int
    {
        $lomba = Lomba::factory()->create(
            [
                'event_id' => $event_id,
            ]
        );
        return $lomba->id;
    }

    private function createKategoriLomba($lomba_id, $kategori_id): int
    {
        $kategori_lomba = KategoriLomba::factory()->create(
            [
                'lomba_id' => $lomba_id,
                'kategori_id' => $kategori_id,
            ]
        );
        return $kategori_lomba->id;
    }

    private function setUpEvent(): void
    {
        $id_kategori = $this->createKategori('sport');
        $id_event = $this->createEvent();
        $id_lomba = $this->createLomba($id_event);
        $this->createKategoriLomba($id_lomba, $id_kategori);
    }

    public function test_get_event_by_kategori()
    {
        $this->setUpEvent();

        $response = $this->get('/api/event/sport');
        $response->assertStatus(200);
    }

    public function test_json_respone_get_event_by_kategori()
    {
        $this->setUpEvent();

        $response = $this->get('/api/event/sport');
        $response->assertJsonStructure(
            [
                "current_page",
                "data",
                "first_page_url",
                "from",
                "last_page",
                "last_page_url",
                "links",
                "next_page_url",
                "path",
                "per_page",
                "prev_page_url",
                "to",
                "total",
            ]
        );
        $response->assertJson(
            [
                "current_page" => 1,
                "per_page" => 10,
            ]
        );
        $response->assertStatus(200);
    }

    public function test_get_event_by_kategori_not_found()
    {
        $this->setUpEvent();

        $response = $this->get('/api/event/gakAda');
        $response->assertJson(
            [
                'data' => [],
            ]
        );
        $response->assertStatus(200);
    }
}
