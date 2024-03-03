<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gift extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image',
        'cost',
        'gift_type_id'
    ];

    public function giftType()
    {
        return $this->belongsTo(GiftType::class);
    }
}
