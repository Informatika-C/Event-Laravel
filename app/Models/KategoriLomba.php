<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriLomba extends Model
{
    use HasFactory;
    protected $table = 'kategori_lomba';

    
    protected $fillable = [
        'nama_kategori', 'deskripsi',
    ];  
}
