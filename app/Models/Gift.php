<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Gift extends Model
{
    use HasFactory , SoftDeletes;

    protected $fillable = [
        'name',
        'image',
        'cost',
        'gift_type_id',
        'active',
        'description',
        'is_accepted'
    ];

    public function scopeActive($query){
        return $query->where('active', 1);
    }

    public function giftType()
    {
        return $this->belongsTo(GiftType::class);
    }
}
