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
}
