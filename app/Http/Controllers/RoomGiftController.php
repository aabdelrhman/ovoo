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
            auth()->user()->giftSents()->attach($data['gift_id'], [
                'room_id' => $data['room_id'],
                'gift_count' => $data['gift_count'],
                'room_creater_id' => Room::find($data['room_id'])?->user_id
            ]);
            return $this->returnSuccessRespose('Success');
        } catch (\Throwable $th) {
            return $this->returnErrorRespose($th->getMessage(), 500);
        }
    }
}
