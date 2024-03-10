<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\GiftTypeRequest;
use App\Http\Resources\GiftTypesResource;
use App\Models\GiftType;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class GiftTypeController extends Controller
{
    use ApiResponse;

    public function index(){
        try {
            return $this->returnSuccessRespose('Success',GiftTypesResource::collection(GiftType::all()));
        } catch (\Throwable $th) {
            return $this->returnErrorRespose($th->getMessage(), 500);
        }
    }

    public function store(GiftTypeRequest $request){
        try {
            $gift_type = GiftType::create($request->validated());
            return $this->returnSuccessRespose('Success',new GiftTypesResource($gift_type));
        } catch (\Throwable $th) {
            return $this->returnErrorRespose($th->getMessage(), 500);
        }
    }
    public function show($gift_type){
        try {
            return $this->returnSuccessRespose('Success', new GiftTypesResource(GiftType::findOrFail($gift_type)));
        } catch (\Throwable $th) {
            return $this->returnErrorRespose($th->getMessage(), 500);
        }
    }

    public function update(GiftTypeRequest $request , $gift_type){
        try {
            $gift_type = GiftType::find($gift_type);
            $gift_type->update($request->validated());
            return $this->returnSuccessRespose('Success',new GiftTypesResource($gift_type));
        } catch (\Throwable $th) {
            return $this->returnErrorRespose($th->getMessage(), 500);
        }
    }

    public function destroy ($gift_type){
        try {
            $gift_type = GiftType::find($gift_type)->delete();
            return $this->returnSuccessRespose('Success');
        } catch (\Throwable $th) {
            return $this->returnErrorRespose($th->getMessage(), 500);
        }
    }
}
