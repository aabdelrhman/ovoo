<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RoomLevelRequest;
use App\Http\Resources\RoomLevelResource;
use App\Models\RoomLevel;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class RoomLevelController extends Controller
{
    use ApiResponse;
    public function store(RoomLevelRequest $request){
        try {
            $roomLevel = RoomLevel::create($request->validated());
            return $this->returnSuccessRespose('Success',new RoomLevelResource($roomLevel));
        } catch (\Throwable $th) {
            return $this->returnErrorRespose($th->getMessage(), 500);
        }
    }

    public function show($roomLevel){
        try {
            return $this->returnSuccessRespose('Success', new RoomLevelResource(RoomLevel::findOrFail($roomLevel)));
        } catch (\Throwable $th) {
            return $this->returnErrorRespose($th->getMessage(), 500);
        }
    }

    public function update(RoomLevelRequest $request , $roomLevel){
        try {
            $roomLevel = RoomLevel::find($roomLevel);
            $roomLevel->update($request->validated());
            return $this->returnSuccessRespose('Success',new RoomLevelResource($roomLevel));
        } catch (\Throwable $th) {
            return $this->returnErrorRespose($th->getMessage(), 500);
        }
    }

    public function destroy ($roomLevel){
        try {
            $roomLevel = RoomLevel::find($roomLevel)->delete();
            return $this->returnSuccessRespose('Success');
        } catch (\Throwable $th) {
            return $this->returnErrorRespose($th->getMessage(), 500);
        }
    }
}
