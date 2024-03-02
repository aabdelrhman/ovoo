<?php

namespace App\Http\Controllers;

use App\Http\Requests\Api\RoomRequest;
use App\Http\Resources\RoomResource;
use App\Models\Room;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    use ApiResponse;
    public function store(RoomRequest $request)
    {
        try {
            $data = $request->validated();
            $data['user_id'] = auth()->user()->id;
            $room = Room::create($data);
            return $this->returnSuccessRespose('Success' , new RoomResource($room));
        } catch (\Throwable $th) {
            return $this->returnErrorRespose($th->getMessage(), 500);
        }
    }
}