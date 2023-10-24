<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventLomba extends Model
{
    use HasFactory;
    protected $table = 'event_lomba';

    
    protected $fillable = [
        'nama_lomba', 'deskripsi', 'tempat','tanggal_pendaftaran','tanggal_penutupan_pendaftaran','tanggal_pelaksanaan','kuota','penyelenggara_id',
    ];    

 
}
