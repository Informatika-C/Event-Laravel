<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Penyelenggara extends Model
{
    use HasFactory;

    protected $table = 'penyelenggara';

    protected $primaryKey = 'id';

    protected $fillable = [
        'nama_penyelenggara',
        'no_telp',
    ];
    public function events(): HasMany
    {
        return $this->hasMany(EventLomba::class, 'penyelenggara_id');
    }
}
