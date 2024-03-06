<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VipType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'image',
        'active',
        'price_in_month'
    ];

    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }

    public function scopeInactive($query)
    {
        return $query->where('active', 0);
    }

    public function vipTypeExclusivePrivileges()
    {
        return $this->hasMany(VipTypeExclusivePrivilege::class);
    }

    public function vipTypeIdentifications()
    {
        return $this->hasMany(VipTypeIdentification::class);
    }
}
