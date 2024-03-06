<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Observers\UserObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


#[ObservedBy([UserObserver::class])]
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'active',
        'verification_code',
        'user_name',
        'provider',
        'uid',
        'photo_url',
        'firebase_id_token',
        'nonce',
        'country_code',
        'country_id',
        'gender',
        'is_profile_completed',
        'country_flag',
        'date_of_birth',
        'current_rank_id',
        'next_rank_id',
        'vip_type_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];


    protected function UserName(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => rand(1000000000, 9999999999),
        );
    }

    public function interests()
    {
        return $this->belongsToMany(Interest::class, 'users_interests', 'user_id', 'interest_id');
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function followers(){

        return $this->belongsToMany(User::class, 'followers', 'following_id', 'user_id');
    }

    public function followings(){
        return $this->belongsToMany(User::class, 'followers', 'user_id', 'following_id');
    }

    public function rooms()
    {
        return $this->hasMany(Room::class);
    }

    public function giftSents()
    {
        return $this->hasMany(RoomGift::class, 'user_id');
    }

    public function giftReceiveds()
    {
        return $this->hasMany(RoomGift::class, 'room_creater_id');
    }

    public function currentRank()
    {
        return $this->belongsTo(Rank::class , 'current_rank_id');
    }

    public function nextRank()
    {
        return $this->belongsTo(Rank::class , 'next_rank_id');
    }

    public function vipType()
    {
        return $this->belongsTo(VipType::class , 'vip_type_id');
    }
}
