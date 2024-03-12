<?php

namespace App\Http\Controllers;

use App\Models\MedalType;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class MedalTypeController extends Controller
{
    use ApiResponse;
    public function index()
    {
        try {
            $medal_types = MedalType::all();
            return $this->returnSuccessRespose('Success', $medal_types);
        } catch (\Throwable $th) {
            return $this->returnErrorRespose($th->getMessage(), 500);
        }
    }
}
