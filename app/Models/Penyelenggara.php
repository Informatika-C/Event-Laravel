<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class penyelenggara extends Model
{
    use HasFactory;
    protected $table = 'penyelenggara';

    
    protected $fillable = [
        'nama_penyelenggara', 'no_telp',
    ];  
}
