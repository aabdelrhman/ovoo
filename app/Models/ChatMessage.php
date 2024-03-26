<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatMessage extends Model
{
    use HasFactory;

    protected $fillable = [
        'sender_id',
        'message',
        'type',
        'chat_id',
        'seen_at',
        'seen_by',
        'agency_id',

    ];


    public function chat(){
        return $this->belongsTo(Chat::class);
    }

    public function sender(){
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function seenBy(){
        return $this->belongsTo(User::class, 'seen_by');
    }

    public function agency(){
        return $this->belongsTo(Agency::class);
    }
}
