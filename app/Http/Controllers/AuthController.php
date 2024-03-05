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
use App\Http\Requests\CompleteProfileRequest;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    use ApiResponse;
    public function socialAuth(SocialAuthRequest $request)
    {
        $user = User::where('email', $request->email)->first();
        if ($user) {
            // $is_uid_correct = Hash::check($request->uid, $user->uid);
            // if (!$is_uid_correct) {
            //     return $this->returnErrorRespose('Invalid Credentials', 404);
            // } else {
                return $this->returnSuccessRespose('Success', new UserResource($user, 'useToken'), 200);
            // }
        } else {
            $user = User::create([
                'email' => $request->email,
                'name' => $request->name,
                'provider' => $request->provider,
                'photo_url' => $request->photo_url,
                'active' => '1',
                'current_rank_id' => 1,
                'next_rank_id' => 2,
            ]);
            $user->uid = Hash::make($request->uid);
            $user->save();
            return $this->returnSuccessRespose('Success', new UserResource($user, 'useToken'), 200);
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
                'verification_code' => $verificationCode,
                'current_rank_id' => 1,
                'next_rank_id' => 2,
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
                return $this->returnSuccessRespose('Success', new UserResource($user, 'useToken'), 200);
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
                    'verification_code' => $smsCode,
                    'country_code' => $request->country_code,
                    'country_flag' => $request->country_flag,
                    'current_rank_id' => 1,
                    'next_rank_id' => 2,
                ]);
            }
            $smsService->sendSMS($request->phone, $smsCode);
            return $this->returnSuccessRespose('Success', null, 200);
        } catch (Exception $e) {
            return $this->returnErrorRespose($e->getMessage(), 500);
        }
    }

    public function resendVerificationCode(Request $request, SmsService $smsService)
    {
        try {
            $user = User::where('email', $request->data)->orWhere('phone', $request->data)->first();
            if ($user) {
                if ($user->phone == $request->data) {
                    $smsCode = generateSmsCode();
                    $user->verification_code = $smsCode;
                    $user->save();
                    $smsService->sendSMS($request->phone, $smsCode);
                } else if ($user->email == $request->data) {
                    $verificationCode = generateEmailCode();
                    $user->verification_code = $verificationCode;
                    $user->save();
                    Mail::to($request->data)->send(new VerfiyUserEmail([
                        'code' => $verificationCode,
                    ]));
                }

                return $this->returnSuccessRespose('Success', null, 200);
            } else {
                return $this->returnErrorRespose('Invalid Credentials', 400);
            }
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
                if ($request->from_register == 1) {
                    return $this->returnSuccessRespose('Success', new UserResource($user, 'useToken'), 200);
                } else {
                    return $this->returnSuccessRespose('Success', null, 200);
                }
            } else {
                return $this->returnErrorRespose('Invalid Code', 400);
            }
        } catch (Exception $e) {
            return $this->returnErrorRespose($e->getMessage(), 500);
        }
    }

    public function sendResetPasswordEmail(Request $request)
    {
        try {
            $user = User::where('email', $request->email)->first();
            if ($user) {
                $verificationCode = generateEmailCode();
                $user->verification_code = $verificationCode;
                $user->save();
                Mail::to($request->email)->send(new VerfiyUserEmail([
                    'code' => $verificationCode,
                ]));
                return $this->returnSuccessRespose('Success', null, 200);
            } else {
                return $this->returnErrorRespose('Invalid Email', 400);
            }
        } catch (Exception $e) {
            return $this->returnErrorRespose($e->getMessage(), 500);
        }
    }


    public function resetPassword(Request $request)
    {
        try {
            $user = User::where('email', $request->email)->first();
            if ($user) {
                $user->password = Hash::make($request->password);
                $user->save();
                return $this->returnSuccessRespose('Success', null, 200);
            } else {
                return $this->returnErrorRespose('Invalid Email', 400);
            }
        } catch (Exception $e) {
            return $this->returnErrorRespose($e->getMessage(), 500);
        }
    }

    public function completeProfile(CompleteProfileRequest $request)
    {
        try {
            $user = User::with('interests', 'country')->find(auth('sanctum')->user()->id);
            $user_interests = $request->interests;
            $user->interests()->sync($user_interests);
            $user->country_id = $request->country_id;
            $user->gender = $request->gender;
            $user->date_of_birth = $request->date_of_birth;
            $user->is_profile_completed = 1;
            $user->save();
            return $this->returnSuccessRespose('Success', new UserResource($user, 'useToken'), 200);
        } catch (Exception $e) {
            return $this->returnErrorRespose($e->getMessage(), 500);
        }
    }

    public function editProfile(Request $request)
    {
        try {
            $user = Auth('sanctum')->user();
            $user = User::find($user->id)->with('interests', 'country')->first();
            $user->user_name = $request->user_name;
            $user->gender = $request->gender;
            $user->date_of_birth = $request->date_of_birth;
            $user->country_id = $request->country_id;
            $user->save();
            return $this->returnSuccessRespose('Success', new UserResource($user, 'useToken'), 200);
        } catch (Exception $e) {
            return $this->returnErrorRespose($e->getMessage(), 500);
        }
    }

    public function getProfile(Request $request)
    {
        try {
            $user = Auth('sanctum')->user();
            $user = User::find($user->id)->with('interests', 'country')->first();
            return $this->returnSuccessRespose('Success', new UserResource($user, 'useToken'), 200);
        } catch (Exception $e) {
            return $this->returnErrorRespose($e->getMessage(), 500);
        }
    }
}
