<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomGift extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'room_id',
        'room_creater_id',
        'gift_id'
    ];

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function gift()
    {
        return $this->belongsTo(Gift::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function roomCreater()
    {
        return $this->belongsTo(User::class , 'room_creater_id');
    }
}
