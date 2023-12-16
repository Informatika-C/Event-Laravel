<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;

class EventLomba extends Model
{
    use HasFactory;

    protected $table = 'event_lomba';

    protected $primaryKey = 'id';

    protected $fillable = [
        'nama_lomba', 'deskripsi',
        'tempat', 'tanggal_pendaftaran',
        'tanggal_penutupan_pendaftaran',
        'tanggal_pelaksanaan', 'penyelenggara_id',
        'banner', 'poster'
    ];

    public function penyelenggara(): HasOne
    {
        return $this->hasOne(Penyelenggara::class, "id", "penyelenggara_id");
    }

    public function lomba(): HasMany
    {
        return $this->hasMany(Lomba::class, "event_id", "id");
    }

    public function kategori(): HasMany
    {
        return $this->hasMany(Lomba::class, "id", "event_id");
    }

    public function getKategori(): ?array
    {
        if ($this->lomba == null) {
            return null;
        }

        $kategori = [];

        foreach ($this->lomba as $lomba) {
            foreach ($lomba->kategori as $kategori_lomba) {
                array_push($kategori, $kategori_lomba->nama_kategori);
            }
        }

        $kategori = array_count_values($kategori);
        $kategori = array_keys($kategori);

        return $kategori;
    }

    public static function getByKategori($nama_kategori): ?array
    {
        $event = EventLomba::whereHas('lomba.kategori', function ($query) use ($nama_kategori) {
            $query->where('nama_kategori', $nama_kategori);
        })->get();

        if ($event == null) {
            return null;
        }

        // change nama_lomba to nama_event
        foreach ($event as $e) {
            $e['nama_event'] = $e['nama_lomba'];
            unset($e['nama_lomba']);
        }

        $event = $event->toArray();

        return $event;
    }

    public static function getWithDetailById($id): ?array
    {
        $event = EventLomba::with('penyelenggara', 'lomba')->find($id);

        if ($event == null) {
            return null;
        }

        // change nama_lomba to nama_event
        $event['nama_event'] = $event['nama_lomba'];
        unset($event['nama_lomba']);

        $event = $event->toArray();
        return $event;
    }
}
