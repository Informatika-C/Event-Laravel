<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LombaKelompok extends Model
{
    use HasFactory;

    protected $table = 'lomba_kelompok';

    protected $primaryKey = 'id';

    protected $fillable = ['lomba_id', 'kelompok_id', 'lunas'];
}
