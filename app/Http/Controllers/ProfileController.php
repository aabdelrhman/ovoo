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
    public function getProfile(){
        try {
            $data = User::withCount('followers' , 'followings')->findOrFail(auth()->user()->id);
            return $this->returnSuccessRespose('Success' , new UserResource($data));
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
