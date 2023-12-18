<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Lomba extends Model
{
    use HasFactory;
    protected $table = 'lomba';

    protected $primaryKey = 'id';

    protected $fillable = [
        'event_id',
        'nama_lomba',
        'max_anggota',
        'biaya_registrasi',
        'keterangan',
        'ruangan_lomba',
        'kuota_lomba',
        'pelaksanaan_lomba'
    ];

    public function event()
    {
        return $this->belongsTo(EventLomba::class, 'event_id');
    }

    public function kategori()
    {
        return $this->belongsToMany(Kategori::class, 'kategori_lomba');
    }

    public function kelompok()
    {
        return $this->belongsToMany(Kelompok::class, 'lomba_kelompok');
    }

    public static function getPesertaRegistered($lomba_id)
    {
        $lomba_kelompok = LombaKelompok::where('lomba_id', $lomba_id)->get();
        $jumlah_peserta = 0;
        foreach ($lomba_kelompok as $lomba) {
            $jumlah_peserta += KelompokPeserta::where('kelompok_id', $lomba->kelompok_id)->count();
        }
        return $jumlah_peserta;
    }
}
