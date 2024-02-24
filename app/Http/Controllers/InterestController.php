<?php

namespace App\Http\Controllers;

use App\Http\Resources\InterestResource;
use Illuminate\Http\Request;
use App\Models\Interest;
use App\Traits\ApiResponse;

class InterestController extends Controller
{
    use ApiResponse;
    public function getAllInterests()
    {
        try {
            $interests = InterestResource::collection(Interest::all());
            return $this->returnSuccessRespose('Success', $interests);
        } catch (\Throwable $th) {
            return $this->returnErrorRespose($th->getMessage(), 500);
        }
    }
}
