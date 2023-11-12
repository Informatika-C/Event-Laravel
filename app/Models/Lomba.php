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

    protected $fillable = ['event_id', 'nama_lomba', 'keterangan', 'ruangan_lomba', 'kuota_lomba', 'pelaksanaan_lomba'];

    public function event(): HasOne
    {
        return $this->hasOne(EventLomba::class, "id", "penyelenggara_id");
    }
}
