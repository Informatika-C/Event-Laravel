<?php

namespace Tests\Feature;

use App\Models\EventLomba;
use App\Models\Kategori;
use App\Models\KategoriLomba;
use App\Models\Lomba;
use App\Models\Penyelenggara;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EventApiTest extends TestCase
{
    use RefreshDatabase;

    private function createPenyelenggara(): int
    {
        $penyelenggara = Penyelenggara::factory()->create();
        return $penyelenggara->id;
    }

    public function createKategori($nama_kategori): int
    {
        $kategori = Kategori::factory()->create(
            [
                'nama_kategori' => $nama_kategori,
            ]
        );
        return $kategori->id;
    }

    private function createEvent($penyelenggara_id): int
    {
        $event = EventLomba::factory()->create(
            [
                'penyelenggara_id' => $penyelenggara_id,
            ]
        );
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


    public function test_get_event_by_kategori()
    {
        $id_penyelenggara = $this->createPenyelenggara();
        $id_kategori = $this->createKategori('sport');

        $id_event = $this->createEvent($id_penyelenggara);
        $id_lomba = $this->createLomba($id_event);
        $this->createKategoriLomba($id_lomba, $id_kategori);

        $response = $this->get('/api/event/kategori/sport');
        $response->assertStatus(200);
    }

    public function test_json_respone_get_event_by_kategori()
    {
        $id_penyelenggara = $this->createPenyelenggara();
        $id_kategori = $this->createKategori('sport');

        $id_event = $this->createEvent($id_penyelenggara);
        $id_lomba = $this->createLomba($id_event);
        $this->createKategoriLomba($id_lomba, $id_kategori);

        $id_event = $this->createEvent($id_penyelenggara);
        $id_lomba = $this->createLomba($id_event);
        $this->createKategoriLomba($id_lomba, $id_kategori);

        $response = $this->get('/api/event/kategori/sport');
        $response->assertJsonStructure(
            [
                '*' => [
                    "id",
                    "nama_event",
                    "deskripsi",
                    "tanggal_pelaksanaan",
                    "tanggal_pendaftaran",
                    "tanggal_penutupan_pendaftaran",
                    "banner",
                    "poster",
                    "penyelenggara"
                ]
            ]
        );
        $response->assertJsonCount(2);
        $response->assertStatus(200);
    }

    public function test_get_event_by_kategori_not_found()
    {
        $id_penyelenggara = $this->createPenyelenggara();
        $id_kategori = $this->createKategori('sport');

        $id_event = $this->createEvent($id_penyelenggara);
        $id_lomba = $this->createLomba($id_event);
        $this->createKategoriLomba($id_lomba, $id_kategori);

        $response = $this->get('/api/event/kategori/gakAda');
        $response->assertStatus(404);
    }

    public function test_get_event_detail()
    {
        $id_penyelenggara = $this->createPenyelenggara();
        $id_kategori = $this->createKategori('sport');

        $id_event = $this->createEvent($id_penyelenggara);
        $id_lomba = $this->createLomba($id_event);
        $this->createKategoriLomba($id_lomba, $id_kategori);

        $response = $this->get('/api/event/detail/' . $id_event);
        $response->assertStatus(200);
    }

    public function test_get_event_detail_not_found()
    {
        $id_penyelenggara = $this->createPenyelenggara();
        $id_kategori = $this->createKategori('sport');

        $id_event = $this->createEvent($id_penyelenggara);
        $id_lomba = $this->createLomba($id_event);
        $this->createKategoriLomba($id_lomba, $id_kategori);

        $response = $this->get('/api/event/detail/99999');
        $response->assertStatus(404);
    }

    public function test_json_respone_get_event_detail()
    {
        $id_penyelenggara = $this->createPenyelenggara();
        $id_kategori = $this->createKategori('sport');

        $id_event = $this->createEvent($id_penyelenggara);
        $id_lomba = $this->createLomba($id_event);
        $this->createKategoriLomba($id_lomba, $id_kategori);

        $response = $this->get('/api/event/detail/' . $id_event);
        $response->assertJsonStructure(
            [
                "id",
                "nama_event",
                "deskripsi",
                "tempat",
                "tanggal_pendaftaran",
                "tanggal_penutupan_pendaftaran",
                "tanggal_pelaksanaan",
                "banner",
                "poster",
                "penyelenggara" => [
                    "id",
                    "nama_penyelenggara",
                    "logo",
                    "no_telp",
                ],
                "lomba" => [
                    '*' => [
                        "id",
                        "nama_lomba",
                        "deskripsi",
                        "max_anggota",
                        "biaya_registrasi",
                        "poster",
                        "ruangan_lomba",
                        "kuota_lomba",
                        "pelaksanaan_lomba",
                    ]
                ]
            ]
        );
        $response->assertStatus(200);
    }
}
