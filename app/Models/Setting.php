<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = ['category', 'key', 'value'];

    protected $casts = [];

    protected function value(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => isJson($value) ? json_decode($value, true) : $value,
        );
    }
}
