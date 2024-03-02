<?php

namespace App\Http\Controllers;

use App\Http\Resources\RoomLevelBackgroundResource;
use App\Models\RoomLevelBackground;
use App\Traits\ApiResponse;

class RoomLevelBackgroundController extends Controller
{
    use ApiResponse;
    public function index($level_id)
    {
        try {
            $backgrounds = RoomLevelBackgroundResource::collection(RoomLevelBackground::where('level_id' , $level_id)->get());
            return $this->returnSuccessRespose('Success', $backgrounds );
        } catch (\Throwable $th) {
            return $this->returnErrorRespose($th->getMessage(), 500);
        }
    }
}
