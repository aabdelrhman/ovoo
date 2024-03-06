<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VipTypeIdentification extends Model
{
    use HasFactory;

    protected $fillable = [
        'vip_type_id',
        'identification_id',
    ];
}
