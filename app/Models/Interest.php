<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Interest extends Model
{
    use HasFactory , SoftDeletes;
    protected $fillable = ['name' , 'active'];

    public function users()
    {
        return $this->belongsToMany(User::class, 'users_interests', 'interest_id', 'user_id');
    }

    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }
}
