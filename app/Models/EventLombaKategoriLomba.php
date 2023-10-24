<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventLombaKategoriLomba extends Model
{
    use HasFactory;
    protected $table = 'event_lomba_kategori_lomba';

    
    protected $fillable = [
        'event_lomba_id', 'kategori_lomba_id',
    ];    
}
