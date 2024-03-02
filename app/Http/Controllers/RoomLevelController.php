<?php

namespace App\Http\Controllers;

use App\Http\Resources\RoomLevelResource;
use App\Models\RoomLevel;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class RoomLevelController extends Controller
{
    use ApiResponse;
    public function index()
    {
        try {
            $levels = RoomLevelResource::collection(RoomLevel::all());
            return $this->returnSuccessRespose('Success', $levels );
        } catch (\Throwable $th) {
            return $this->returnErrorRespose($th->getMessage(), 500);
        }
    }
}
