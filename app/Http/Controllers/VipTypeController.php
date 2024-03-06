<?php

namespace App\Http\Controllers;

use App\Http\Resources\VipTypeResource;
use App\Models\ExclusivePrivilege;
use App\Models\Identification;
use App\Models\VipType;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class VipTypeController extends Controller
{

    use ApiResponse;

    public function index()
    {
        try {
            $vipTypes = VipTypeResource::collection(VipType::active()->get());
            return $this->returnSuccessRespose('Success', $vipTypes);
        } catch (\Throwable $th) {
            return $this->returnErrorRespose($th->getMessage(), 500);
        }
    }

    public function show($id){
        try {
            $vipType = VipType::with('vipTypeIdentifications' , 'vipTypeExclusivePrivileges')->find($id);
            $vipType->total_identifications = Identification::count();
            $vipType->total_exclusive = ExclusivePrivilege::count();
            return $this->returnSuccessRespose('Success', new VipTypeResource($vipType));
        } catch (\Throwable $th) {
            return $this->returnErrorRespose($th->getMessage(), 500);
        }
    }
}
