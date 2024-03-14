<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\RoomResource;
use App\Models\Room;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    use ApiResponse;

    public function index(){
        try {
            return $this->returnSuccessRespose('Success',RoomResource::collection(Room::all()));
        } catch (\Throwable $th) {
            return $this->returnErrorRespose($th->getMessage(), 500);
        }
    }
}
