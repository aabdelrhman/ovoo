<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'status',
        'coins_target',
        'membership_fees',
        'visitors_target',
        'gifts_target',
        'user_id',
        'interest_id',
        'level_id',
        'level_background_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function interest()
    {
        return $this->belongsTo(Interest::class);
    }

    public function level()
    {
        return $this->belongsTo(RoomLevel::class , 'level_id');
    }

    public function levelBackground()
    {
        return $this->belongsTo(RoomLevelBackground::class , 'level_background_id');
    }
}
