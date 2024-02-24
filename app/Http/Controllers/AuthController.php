<?php

namespace App\Http\Controllers;

use App\Http\Requests\Api\LoginWithEmailRequest;
use App\Http\Requests\Api\LoginWithPhoneRequest;
use App\Http\Requests\Api\SignUpWithEmailRequest;
use App\Http\Resources\UserResource;
use App\Mail\VerfiyUserEmail;
use App\Models\User;
use App\Services\SmsService;
use App\Traits\ApiResponse;
use App\Traits\UserTrait;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\Api\SocialAuthRequest;

class AuthController extends Controller
{
    use ApiResponse;
    public function socialAuth(SocialAuthRequest $request)
    {
        // dd($request->all());
        $user = User::where('email', $request->email)->first();
        if ($user) {
            $is_uid_correct = Hash::check($request->uid, $user->uid);
            if (!$is_uid_correct) {
                return $this->returnErrorRespose('Invalid Credentials', 401);
            } else {
                return $this->returnSuccessRespose('Success', new UserResource($user, true), 200);
            }
        } else {
            $user = User::create([
                'email' => $request->email,
                'name' => $request->name,
                'provider' => $request->provider,
                'photo_url' => $request->photo_url,
            ]);
            $user->uid = Hash::make($request->uid);
            $user->save();
            return $this->returnSuccessRespose('Success', new UserResource($user, true), 200);
        }
    }

    public function signUpWithEmail(SignUpWithEmailRequest $request)
    {
        try {
            $verificationCode = generateEmailCode();
            list($username, $domain) = explode('@', $request->email);
            User::create([
                'email' => $request->email,
                'name' => $username,
                'password' => Hash::make($request->password),
                'verification_code' => $verificationCode
            ]);
            Mail::to($request->email)->send(new VerfiyUserEmail([
                'code' => $verificationCode,
            ]));
            return $this->returnSuccessRespose('Success', null, 200);
        } catch (Exception $e) {
            return $this->returnErrorRespose($e->getMessage(), 500);
        }
    }

    public function loginWithEmail(LoginWithEmailRequest $request)
    {
        try {
            $user = User::where('email', $request->email)->first();
            if ($user && Hash::check($request->password, $user->password)) {
                return $this->returnSuccessRespose('Success', new UserResource($user, true), 200);
            } else {
                return $this->returnErrorRespose('Invalid Credentials', 401);
            }
        } catch (Exception $e) {
            return $this->returnErrorRespose($e->getMessage(), 500);
        }
    }

    public function loginWithPhone(LoginWithPhoneRequest $request, SmsService $smsService)
    {
        try {
            $smsCode = generateSmsCode();
            $user = User::where($request->validated())->first();
            if (!$user) {
                User::create([
                    'phone' => $request->phone,
                    'verification_code' => $smsCode
                ]);
            }
            $smsService->sendSMS($request->phone, $smsCode);
            return $this->returnSuccessRespose('Success', null, 200);
        } catch (Exception $e) {
            return $this->returnErrorRespose($e->getMessage(), 500);
        }
    }

    public function verifyCode(Request $request)
    {
        try {
            $user = User::where('verification_code', $request->code)->Where(function ($q) use ($request) {
                $q->where('email', $request->data)->orWhere('phone', $request->data);
            })->first();
            if ($user) {
                if ($user->active == '0') {
                    $user->active = '1';
                    $user->save();
                }
                return $this->returnSuccessRespose('Success', new UserResource($user, true), 200);
            } else {
                return $this->returnErrorRespose('Invalid Code', 400);
            }
        } catch (Exception $e) {
            return $this->returnErrorRespose($e->getMessage(), 500);
        }
    }
}
