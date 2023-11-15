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

    public function event()
    {
        return $this->belongsTo(EventLomba::class, 'event_id');
    }
    public function kategori()
    {
        return $this->belongsToMany(Kategori::class, 'kategori_lomba');
    }
}
