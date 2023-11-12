<?php

namespace App\Models;

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
        'tempat', 'tanggal_pendaftaran', 'tanggal_penutupan_pendaftaran', 'tanggal_pelaksanaan', 'kuota', 'penyelenggara_id',
    ];

    public function penyelenggara(): HasOne
    {
        return $this->hasOne(Penyelenggara::class, "id", "penyelenggara_id");
    }

    public function kategori(): HasMany
    {
        return $this->hasMany(Lomba::class, 'event_id', 'id');
    }
}
