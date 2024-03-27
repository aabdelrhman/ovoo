<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    use ApiResponse;
    public function index()
    {
        try {
            $users = UserResource::collection(User::all());
            return $this->returnSuccessRespose('Success', $users);
        } catch (\Throwable $th) {
            return $this->returnErrorRespose($th->getMessage(), 500);
        }
    }

    public function store(UserRequest $request)
    {
        try {
            $data = $request->validated();
            $data['password'] = Hash::make($data['password']);
            if($request->hasFile('image')){
                $data['image'] = image_resize_save($request->file('image'), 'admin'); ;
            }
            $user = User::create($data);
            return $this->returnSuccessRespose('Success', new UserResource($user));
        } catch (\Throwable $th) {
            return $this->returnErrorRespose($th->getMessage(), 500);
        }
    }

    public function show($id)
    {
        try {
            $user = User::with('country', 'interests', 'giftSents', 'giftReceiveds', 'currentRank', 'nextRank', 'vipType')->withCount('giftSents' , 'giftReceiveds' , 'followings' , 'followers')->findOrFail($id);
            return $this->returnSuccessRespose('Success', new UserResource($user));
        } catch (\Throwable $th) {
            return $th;
            return $this->returnErrorRespose($th->getMessage(), 500);
        }
    }

    public function blockUser($id){
        try {
            $user = User::find($id);
            $user->is_blocked = true;
            $user->save();
            return $this->returnSuccessRespose('Success', new UserResource($user));
        } catch (\Throwable $th) {
            return $this->returnErrorRespose($th->getMessage(), 500);
        }
    }

    public function unBlockUser($id){
        try {
            $user = User::find($id);
            $user->is_blocked = false;
            $user->save();
            return $this->returnSuccessRespose('Success', new UserResource($user));
        } catch (\Throwable $th) {
            return $this->returnErrorRespose($th->getMessage(), 500);
        }
    }

    public function blockedUsers(){
        try {
            $users = User::where('is_blocked', 1)->get();
            return $this->returnSuccessRespose('Success', UserResource::collection($users));
        } catch (\Throwable $th) {
            return $this->returnErrorRespose($th->getMessage(), 500);
        }
    }
}
