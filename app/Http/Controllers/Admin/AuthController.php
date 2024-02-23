<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LoginRequest;
use App\Http\Resources\AdminResource;
use App\Models\Admin;
use App\Traits\ApiResponse;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
}
