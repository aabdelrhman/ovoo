<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\GiftRequest;
use App\Http\Resources\GiftResource;
use App\Models\Gift;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class GiftController extends Controller
{
    use ApiResponse;

    public function index(){
        try {
            return $this->returnSuccessRespose('Success',GiftResource::collection(Gift::with('giftType')->get()));
        } catch (\Throwable $th) {
            return $this->returnErrorRespose($th->getMessage(), 500);
        }
    }

    public function store(GiftRequest $request){
        try {
            $interest = Gift::create($request->validated());
            return $this->returnSuccessRespose('Success',new GiftResource($interest));
        } catch (\Throwable $th) {
            return $this->returnErrorRespose($th->getMessage(), 500);
        }
    }
    public function show($interest){
        try {
            return $this->returnSuccessRespose('Success', new GiftResource(Gift::with('giftType')->findOrFail($interest)));
        } catch (\Throwable $th) {
            return $this->returnErrorRespose($th->getMessage(), 500);
        }
    }

    public function update(GiftRequest $request , $interest){
        try {
            $interest = Gift::find($interest);
            $interest->update($request->validated());
            return $this->returnSuccessRespose('Success',new GiftResource($interest));
        } catch (\Throwable $th) {
            return $this->returnErrorRespose($th->getMessage(), 500);
        }
    }

    public function destroy ($interest){
        try {
            $interest = Gift::find($interest)->delete();
            return $this->returnSuccessRespose('Success');
        } catch (\Throwable $th) {
            return $this->returnErrorRespose($th->getMessage(), 500);
        }
    }
}
