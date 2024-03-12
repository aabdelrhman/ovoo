<?php

namespace App\Http\Controllers;

use App\Http\Resources\MedalResource;
use App\Models\Medal;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class MedalController extends Controller
{

    use ApiResponse;
    public function index($id)
    {
        try {
            $medals = Medal::where('medal_type_id', $id)->with('medalType')->get();
            return $this->returnSuccessRespose('Success', MedalResource::collection($medals));
        } catch (\Throwable $th) {
            return $this->returnErrorRespose($th->getMessage(), 500);
        }
    }
}
