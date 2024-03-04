<?php

namespace App\Http\Controllers;

use App\Http\Requests\Api\FollowRequest;
use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class FollowerController extends Controller
{
    use ApiResponse;
    public function follow(FollowRequest $request){
        try {
            $data = $request->validated();
            User::find(auth()->user()->id)->followings()->create($data);
            return $this->returnSuccessRespose('Success');
        } catch (\Throwable $th) {
            return $this->returnErrorRespose($th->getMessage(), 500);
        }
    }

    public function unFollow(FollowRequest $request){
        try {
            $data = $request->validated();
            User::find(auth()->user()->id)->followings()->detach($data);
            return $this->returnSuccessRespose('Success');
        } catch (\Throwable $th) {
            return $this->returnErrorRespose($th->getMessage(), 500);
        }
    }
}
