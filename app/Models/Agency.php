<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Schema\Builder as SchemaBuilder;

class Agency extends Model
{
    use HasFactory , SoftDeletes;

    protected $fillable = [
        'name' ,
        'description',
        'photo' ,
        'active'
    ];


    public function users(){
        return $this->BelongsToMany(User::class , 'agency_users' , 'agency_id' , 'user_id');
    }


    public function admins(){
        return $this->users()->where('is_admin' , 1);
    }


    public function scopeActive(SchemaBuilder $query)
    {
        return $query->where('active' , 1);

    }
}
