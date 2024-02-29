<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\InterestRequest;
use App\Http\Resources\InterestResource;
use Illuminate\Http\Request;
use App\Models\Interest;
use App\Traits\ApiResponse;

class InterestController extends Controller
{
    use ApiResponse;

    public function store(InterestRequest $request){
        try {
            $interest = Interest::create($request->validated());
            return $this->returnSuccessRespose('Success',new InterestResource($interest));
        } catch (\Throwable $th) {
            return $this->returnErrorRespose($th->getMessage(), 500);
        }
    }
    public function show($interest){
        try {
            return $this->returnSuccessRespose('Success', new InterestResource(Interest::findOrFail($interest)));
        } catch (\Throwable $th) {
            return $this->returnErrorRespose($th->getMessage(), 500);
        }
    }

    public function update(InterestRequest $request , $interest){
        try {
            $interest = Interest::find($interest);
            $interest->update($request->validated());
            return $this->returnSuccessRespose('Success',new InterestResource($interest));
        } catch (\Throwable $th) {
            return $this->returnErrorRespose($th->getMessage(), 500);
        }
    }

    public function destroy ($interest){
        try {
            $interest = Interest::find($interest)->delete();
            return $this->returnSuccessRespose('Success');
        } catch (\Throwable $th) {
            return $this->returnErrorRespose($th->getMessage(), 500);
        }
    }
}
