<?php

namespace App\Http\Controllers;

use App\Http\Requests\Api\UpdateProfileRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    use ApiResponse;
    public function getProfile($id){
        try {
            $data = User::with('giftReceiveds' , 'giftSents', 'currentRank' , 'nextRank' , 'country')->withCount('followers' , 'followings' , 'giftSents' , 'giftReceiveds')->findOrFail($id);
            return $this->returnSuccessRespose('Success' , new UserResource($data));
        } catch (\Throwable $th) {
            return $this->returnErrorRespose($th->getMessage(), 500);
        }
    }

    public function userSupporters($id){
        try {
            $users = User::whereIn('id', function ($query) use ($id) {
                $query->select('user_id')
                    ->from('room_gifts')
                    ->where('room_creater_id', $id);
            })->select('id','name' ,'user_name', 'photo_url')->get();
            return $this->returnSuccessRespose('Success' , $users);
        } catch (\Throwable $th) {
            return $this->returnErrorRespose($th->getMessage(), 500);
        }
    }

    public function updateProfile(UpdateProfileRequest $request){
        try {
            User::find(auth()->user()->id)->update($request->validated());
            return $this->returnSuccessRespose('Success');
        } catch (\Throwable $th) {
            return $this->returnErrorRespose($th->getMessage(), 500);
        }
    }


}
