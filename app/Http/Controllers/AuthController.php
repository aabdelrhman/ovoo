<?php

namespace App\Http\Controllers;

use App\Http\Requests\Api\LoginWithPhoneRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Services\SmsService;
use App\Traits\ApiResponse;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Http\Request;
use Exception;


class AuthController extends Controller
{

    use ApiResponse;

    public function facebook(Request $request)
    {
        $request->validate([
            'access_token' => 'required',
        ]);

        try {
            $user = Socialite::driver('facebook')->userFromToken($request->access_token);
        } catch (Exception $e) {

            return $this->returnErrorRespose('Unauthorized' , 401);
        }

        // Use $user data to authenticate user or create new user
        return $this->returnSuccessRespose('Success', new UserResource($user), 200);
    }

    public function facebookCallback(Request $request)
    {
        $request->validate([
            'code' => 'required',
        ]);

        try {
            $user = Socialite::driver('facebook')->user();
        } catch (Exception $e) {

            return $this->returnErrorRespose('Unauthorized' , 401);
        }

        // Use $user data to authenticate user or create new user
        return $this->returnSuccessRespose('Success', new UserResource($user), 200);
    }


    public function google(Request $request)
    {
        $request->validate([
            'access_token' => 'required',
        ]);

        try {
            $user = Socialite::driver('google')->userFromToken($request->access_token);
        } catch (Exception $e) {

            return $this->returnErrorRespose('Unauthorized' , 401);
        }

        // Use $user data to authenticate user or create new user
        return $this->returnSuccessRespose('Success', new UserResource($user), 200);
    }

    public function googleCallback(Request $request)
    {
        $request->validate([
            'code' => 'required',
        ]);

        try {
            $user = Socialite::driver('google')->user();
        } catch (Exception $e) {
            return $this->returnErrorRespose('Unauthorized' , 401);
        }

        // Use $user data to authenticate user or create new user
        return $this->returnSuccessRespose('Success', new UserResource($user), 200);
    }

    

    public function loginWithPhone(LoginWithPhoneRequest $request , SmsService $smsService)
    {
        try {
            $smsCode = generateSmsCode();
            $user = User::where($request->validated())->first();
            if($user){
                return $this->returnSuccessRespose('Success', new UserResource($user), 200);
            }else{
                User::create([
                    'phone' => $request->phone,
                    'verification_code' => $smsCode
                ]);
                $smsService->sendSMS($request->phone , $smsCode);
                return $this->returnSuccessRespose('Success', null, 200);
            }
        } catch (Exception $e) {
            return $this->returnErrorRespose($e->getMessage() , 500);
        }
    }

    public function verifyCode(Request $request)
    {
        try {
            $user = User::where([['phone' , $request->phone] , ['verification_code' , $request->code]])->first();
            if($user){
                if($user->active == '0'){
                    $user->active = '1';
                    $user->save();
                }
                return $this->returnSuccessRespose('Success', new UserResource($user) , 200);
            }else{
                return $this->returnErrorRespose('Invalid Code' , 400);
            }
        } catch (Exception $e) {
            return $this->returnErrorRespose($e->getMessage() , 500);
        }
    }


}
