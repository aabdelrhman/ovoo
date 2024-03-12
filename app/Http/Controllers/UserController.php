<?php

namespace App\Http\Controllers;

use App\Http\Resources\MedalResource;
use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    use ApiResponse;

    public function medals($id){
        try {
            $medals = User::with('medals')->find($id)->medals;
            return $this->returnSuccessRespose('Success', MedalResource::collection($medals) );
        } catch (\Throwable $th) {
            return $this->returnErrorRespose($th->getMessage(), 500);
        }
    }
}
