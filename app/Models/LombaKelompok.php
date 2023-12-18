<?php

namespace App\Models;

use App\Events\RegisterLomba;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LombaKelompok extends Model
{
    use HasFactory;

    protected $table = 'lomba_kelompok';

    protected $primaryKey = 'id';

    protected $fillable = ['lomba_id', 'kelompok_id', 'lunas'];

    public function lomba()
    {
        return $this->belongsTo(Lomba::class, 'lomba_id');
    }

    public function kelompok()
    {
        return $this->belongsTo(Kelompok::class, 'kelompok_id');
    }
}
