<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penyelenggara extends Model
{
    use HasFactory;

    protected $table = 'penyelenggara'; // Sesuaikan dengan nama tabel penyelenggara pada database Anda

    protected $fillable = [
        'nama_penyelenggara',
        'no_telp',
    ];
    public function events()
    {
        return $this->hasMany(EventLomba::class, 'penyelenggara_id');
    }
}