<?php

namespace App\Http\Controllers;

use App\Http\Resources\GiftResource;
use App\Http\Resources\GiftTypesResource;
use App\Models\Gift;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class GiftController extends Controller
{
    use ApiResponse;
    public function index($giftType)
    {
        try {
            $gifts = GiftResource::collection(Gift::where('gift_type_id', $giftType)->get());
            return $this->returnSuccessRespose('Success', $gifts);
        } catch (\Throwable $th) {
            return $this->returnErrorRespose($th->getMessage(), 500);
        }
    }

    public function giftTypes()
    {
        try {
            $types = GiftTypesResource::collection(Gift::all());
            return $this->returnSuccessRespose('Success', $types);
        } catch (\Throwable $th) {
            return $this->returnErrorRespose($th->getMessage(), 500);
        }
    }
}
