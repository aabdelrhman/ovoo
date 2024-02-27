<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ForgetPasswordRequest;
use App\Http\Requests\Admin\LoginRequest;
use App\Http\Requests\Admin\ResetPasswordRequest;
use App\Http\Requests\Admin\VerifyEmailRequest;
use App\Http\Resources\AdminResource;
use App\Mail\ForgetPasswordEmail;
use App\Models\Admin;
use App\Traits\ApiResponse;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    use ApiResponse;
    public function login(LoginRequest $request){
        try {
            $admin = Admin::where('email' , $request->email)->first();
            if($admin && Hash::check($request->password , $admin->password)){
                return $this->returnSuccessRespose('Success', new AdminResource($admin , true), 200);
            }else{
                return $this->returnErrorRespose('Invalid Credentials' , 401);
            }
        } catch (Exception $e) {
            return $this->returnErrorRespose($e->getMessage() , 500);
        }
    }

    public function forgetPassword(ForgetPasswordRequest $request){
        try {
            $verificationCode = generateEmailCode();
            $admin = Admin::where('email' , $request->email)->first();
            $admin->update(['verification_code' => $verificationCode]);
            Mail::to($admin->email)->send(new ForgetPasswordEmail([
                'code' => $verificationCode,
            ]));
            return $this->returnSuccessRespose('Code sent successfully',  200);
        } catch (Exception $e) {
            return $this->returnErrorRespose($e->getMessage() , 500);
        }
    }

    public function verifyCode(VerifyEmailRequest $request)
    {
        try {
            $admin = Admin::where([['verification_code', $request->code] , ['email', $request->email]])->first();
            if ($admin) {
                    return $this->returnSuccessRespose('Success', null, 200);
            } else {
                return $this->returnErrorRespose('Invalid Code', 400);
            }
        } catch (Exception $e) {
            return $this->returnErrorRespose($e->getMessage(), 500);
        }
    }

    public function resetPassword(ResetPasswordRequest $request)
    {
        try {
            $admin = Admin::where([['verification_code', $request->code] , ['email', $request->email]])->first();
            if ($admin) {
                $admin->password = Hash::make($request->password);
                $admin->verification_code = null;
                $admin->save();
                return $this->returnSuccessRespose('Success', null, 200);
            } else {
                return $this->returnErrorRespose('Invalid Email', 400);
            }
        } catch (Exception $e) {
            return $this->returnErrorRespose($e->getMessage(), 500);
        }
    }
}
