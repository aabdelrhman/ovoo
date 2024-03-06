<?php

namespace App\Http\Controllers;

use App\Http\Resources\VipTypeResource;
use App\Models\VipType;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class VipTypeController extends Controller
{

    use ApiResponse;

    public function index()
    {
        try {
            $vipTypes = VipTypeResource::collection(VipType::active()->get())->append('total_count_identifications');
            return $this->returnSuccessRespose('Success', $vipTypes);
        } catch (\Throwable $th) {
            return $this->returnErrorRespose($th->getMessage(), 500);
        }
    }

    public function show($id){
        try {
            $vipType = new VipTypeResource(VipType::with('vipTypeIdentifications' , 'vipTypeExclusivePrivileges')->find($id));
            return $this->returnSuccessRespose('Success', $vipType);
        } catch (\Throwable $th) {
            return $this->returnErrorRespose($th->getMessage(), 500);
        }
    }
}
