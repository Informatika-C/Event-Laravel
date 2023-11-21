<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KelompokPeserta extends Model
{
    use HasFactory;

    protected $table = 'kelompok_peserta';

    protected $primaryKey = 'id';

    protected $fillable = ['kelompok_id', 'peserta_id'];
}
