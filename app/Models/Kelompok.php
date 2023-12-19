<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelompok extends Model
{
    use HasFactory;

    protected $table = 'kelompok';

    protected $primaryKey = 'id';

    protected $fillable = ['nama_kelompok', 'ketua_id', 'is_solo'];

    public function ketua()
    {
        return $this->belongsTo(User::class, 'ketua_id');
    }

    public function lomba()
    {
        return $this->belongsToMany(Lomba::class, 'lomba_kelompok');
    }

    public function peserta()
    {
        return $this->belongsToMany(User::class, 'kelompok_peserta', 'kelompok_id', 'peserta_id');
    }
}
