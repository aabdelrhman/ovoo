<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Chat extends Model
{
    use HasFactory , SoftDeletes;

    protected $fillable = ['name'];

    public function messages(){
        return $this->hasMany(ChatMessage::class);
    }

    public function users(){
        return $this->belongsToMany(User::class , 'chat_users' , 'chat_id' , 'user_id');
    }

    public function lastMessage(){
        return $this->messages()->latest()->limit(1);
    }

    public function unreadMessages(){
        return $this->messages()->whereNull('seen_at');
    }
}
