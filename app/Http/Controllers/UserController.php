<?php

namespace App\Http\Controllers;

use App\Http\Resources\MedalResource;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    use ApiResponse;

    public function medals($id){
        try {
            $medals = User::with('medals')->find($id)->medals;
            return $this->returnSuccessRespose('Success', MedalResource::collection($medals) );
        } catch (\Throwable $th) {
            return $this->returnErrorRespose($th->getMessage(), 500);
        }
    }

    public function blockUser($id){
        try {
            $user = User::with('blockedUsers')->find(auth()->user()->id);
            if(!$user->isBlocked($id))
                    $user->blockedUsers()->attach($id);
            return $this->returnSuccessRespose('Success');
        } catch (\Throwable $th) {
            return $this->returnErrorRespose($th->getMessage(), 500);
        }
    }

    public function unBlockUser($id){
        try {
            User::find(auth()->user()->id)->blockedUsers()->detach($id);
            return $this->returnSuccessRespose('Success');
        } catch (\Throwable $th) {
            return $this->returnErrorRespose($th->getMessage(), 500);
        }
    }

    public function userCbs($id){
        try {
            $user = User::whereHas('giftSents' , function($q) use ($id){
                $q->where('room_creater_id' , $id)->whereHas('giftType' , function($q){
                    $q->where('is_cb', 1);
                });
            })->get();
            return $this->returnSuccessRespose('Success', UserResource::collection($user));
        } catch (\Throwable $th) {
            return $this->returnErrorRespose($th->getMessage(), 500);
        }
    }
}
