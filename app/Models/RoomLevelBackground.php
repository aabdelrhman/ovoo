<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomLevelBackground extends Model
{
    use HasFactory;

    protected $fillable = [
        'image' ,
        'level_id'
    ];


    public function level()
    {
        return $this->belongsTo(RoomLevel::class , 'level_id');
    }
}
