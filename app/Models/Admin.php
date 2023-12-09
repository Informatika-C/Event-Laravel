<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use HasApiTokens, Notifiable; 

    protected $table = 'admin';

    protected $guard = 'admin';    
    
    protected $fillable = [
        'name', 'email', 'password',
    ];    

    protected $hidden = [
      'password', 'remember_token',
    ];

    protected $casts = [
        'password' => 'hashed',
    ];
}