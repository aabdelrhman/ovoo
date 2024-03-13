<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GiftType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function scopeIsCp($builder)
    {
        return $builder->where('isCp', 1);
    }
}
