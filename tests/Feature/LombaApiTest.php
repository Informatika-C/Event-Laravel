<?php

namespace Tests\Feature;

use App\Models\EventLomba;
use App\Models\Kategori;
use App\Models\KategoriLomba;
use App\Models\Kelompok;
use App\Models\KelompokPeserta;
use App\Models\Lomba;
use App\Models\LombaKelompok;
use App\Models\Penyelenggara;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LombaApiTest extends TestCase
{
    use RefreshDatabase;

    private function createUser(): int
    {
        $user = \App\Models\User::factory()->create();
        return $user->id;
    }

    private function createKelompok($user_id): int
    {
        $kelompok = Kelompok::factory()->create(
            [
                'ketua_id' => $user_id,
            ]
        );
        return $kelompok->id;
    }

    private function createKelompokPeserta($kelompok_id, $peserta_id): int
    {
        $kelompok_peserta = KelompokPeserta::factory()->create(
            [
                'kelompok_id' => $kelompok_id,
                'peserta_id' => $peserta_id,
            ]
        );
        return $kelompok_peserta->id;
    }

    private function createLombaKelompok($lomba_id, $kelompok_id): int
    {
        $lomba_kelompok = LombaKelompok::factory()->create(
            [
                'lomba_id' => $lomba_id,
                'kelompok_id' => $kelompok_id,
            ]
        );
        return $lomba_kelompok->id;
    }

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

    private function createLomba($event_id, $max_anggota = 1): int
    {
        $lomba = Lomba::factory()->create(
            [
                'event_id' => $event_id,
                'max_anggota' => $max_anggota,
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

    public function test_get_lomba_detail()
    {
        $kategori_id = $this->createKategori('sport');
        $penyelenggara_id = $this->createPenyelenggara();
        $event_id = $this->createEvent($penyelenggara_id);
        $lomba_id = $this->createLomba($event_id);
        $this->createKategoriLomba($lomba_id, $kategori_id);

        $response = $this->get('/api/lomba/detail/' . $lomba_id);

        $response->assertJsonStructure(
            [
                "id",
                "nama_lomba",
                "deskripsi",
                "max_anggota",
                "anggota_terdaftar",
                "biaya_registrasi",
                "poster",
                "ruangan_lomba",
                "kuota_lomba",
                "pelaksanaan_lomba",
                "kategori" => [
                    "*" => [
                        "nama_kategori"
                    ]
                ]
            ]
        );

        $response->assertJson(
            [
                "anggota_terdaftar" => 0,
            ]
        );

        $response->assertStatus(200);
    }

    public function test_get_user_individu_registered()
    {
        $kategori_id = $this->createKategori('sport');
        $penyelenggara_id = $this->createPenyelenggara();
        $event_id = $this->createEvent($penyelenggara_id);
        $lomba_id = $this->createLomba($event_id);
        $this->createKategoriLomba($lomba_id, $kategori_id);

        // create user
        $user_id = $this->createUser();

        // register user to individu_kelompok
        $kelompok_id = $this->createKelompok($user_id);

        // register individu_kelompok peserta
        $this->createKelompokPeserta($kelompok_id, $user_id);

        // register individu_kelompok to lomba
        $this->createLombaKelompok($lomba_id, $kelompok_id);

        $response = $this->get('/api/lomba/detail/' . $lomba_id);

        $response->assertJson(
            [
                "anggota_terdaftar" => 1,
            ]
        );

        $response->assertStatus(200);
    }

    public function test_get_user_kelompok_register()
    {
        $kategori_id = $this->createKategori('sport');
        $penyelenggara_id = $this->createPenyelenggara();
        $event_id = $this->createEvent($penyelenggara_id);
        $lomba_id = $this->createLomba($event_id, 3);
        $this->createKategoriLomba($lomba_id, $kategori_id);

        // create user
        $user1_id = $this->createUser();
        $user2_id = $this->createUser();
        $user3_id = $this->createUser();

        // register user to kelompok
        $kelompok_id = $this->createKelompok($user1_id);

        // register kelompok peserta
        $this->createKelompokPeserta($kelompok_id, $user1_id);
        $this->createKelompokPeserta($kelompok_id, $user2_id);
        $this->createKelompokPeserta($kelompok_id, $user3_id);

        // register kelompok to lomba
        $this->createLombaKelompok($lomba_id, $kelompok_id);

        $response = $this->get('/api/lomba/detail/' . $lomba_id);

        $response->assertJson(
            [
                "anggota_terdaftar" => 3,
            ]
        );

        $response->assertStatus(200);
    }


    public function test_get_lomba_detail_not_found()
    {
        $response = $this->get('/api/lomba/detail/999999');

        $response->assertStatus(404);
    }
}
