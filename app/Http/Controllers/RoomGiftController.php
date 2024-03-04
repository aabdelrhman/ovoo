<?php

namespace App\Http\Controllers;

use App\Http\Requests\Api\SentGiftRequest;
use App\Models\Room;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class RoomGiftController extends Controller
{
    use ApiResponse;
    public function sentGift(SentGiftRequest $request)
    {
        try {
            $data = $request->validated();
            $data['room_creater_id'] = Room::find($data['room_id'])?->user_id;
            auth()->user()->giftSents()->create($data);
            return $this->returnSuccessRespose('Success');
        } catch (\Throwable $th) {
            return $this->returnErrorRespose($th->getMessage(), 500);
        }
    }
}
