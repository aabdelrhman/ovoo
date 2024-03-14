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
            $user = User::create($data);
            return $this->returnSuccessRespose('Success', new UserResource($user));
        } catch (\Throwable $th) {
            return $this->returnErrorRespose($th->getMessage(), 500);
        }
    }

    public function show($id)
    {
        try {
            $user = User::with('country', 'interests', 'giftSents', 'giftReceiveds', 'currentRank', 'nextRank', 'vipType')->findOrFail($id);
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
}
