<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GiftType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name','active','isCp','is_customized'
    ];

    public function scopeIsCp($builder)
    {
        return $builder->where('isCp', 1);
    }
    
    public function scopeIsCustomized($builder)
    {
        return $builder->where('is_customized', 1);
    }


    public function scopeActive($builder)
    {
        return $builder->where('active', 1);
    }
}
