<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class Admin extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens, HasRoles;

    protected $guard = 'admin';
    protected $fillable = [
        'name', 'email', 'password','verification_code','phone' , 'photo' , 'birth_date'
    ];
    protected $hidden = [
        'password',
    ];
}
