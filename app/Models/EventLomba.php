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
        $lomba = Lomba::whereHas('kategori', function ($query) use ($nama_kategori) {
            $query->where('nama_kategori', $nama_kategori);
        })->get();

        return $lomba->toArray();
    }

    public static function getWithPaginateByKategori($nama_kategori, $item = 5): ?array
    {
        $lomba = Lomba::whereHas('kategori', function ($query) use ($nama_kategori) {
            $query->where('nama_kategori', $nama_kategori);
        })->paginate($item);

        return $lomba->toArray();
    }
}
