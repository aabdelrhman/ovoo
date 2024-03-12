<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medal extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image',
        'points',
        'medal_type_id',
        'description',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_medals', 'medal_id', 'user_id');
    }

    public function medalType(){
        return $this->belongsTo(MedalType::class);
    }
}
