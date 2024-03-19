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
            $data = $request->validated();
            if($request->hasFile('image')){
                $data['image'] = image_resize_save($request->file('image'), 'admin'); ;
            }
            $gift = Gift::create($data);
            return $this->returnSuccessRespose('Success',new GiftResource($gift));
        } catch (\Throwable $th) {
            return $this->returnErrorRespose($th->getMessage(), 500);
        }
    }
    public function show($gift){
        try {
            return $this->returnSuccessRespose('Success', new GiftResource(Gift::with('giftType')->findOrFail($gift)));
        } catch (\Throwable $th) {
            return $this->returnErrorRespose($th->getMessage(), 500);
        }
    }

    public function update(GiftRequest $request , $gift){
        try {
            $gift = Gift::find($gift);
            $data = $request->validated();
            if($request->hasFile('image')){
                $data['image'] = image_resize_save($request->file('image'), 'admin'); ;
            }
            $gift->update($data);
            return $this->returnSuccessRespose('Success',new GiftResource($gift));
        } catch (\Throwable $th) {
            return $this->returnErrorRespose($th->getMessage(), 500);
        }
    }

    public function destroy ($gift){
        try {
            $gift = Gift::find($gift)->delete();
            return $this->returnSuccessRespose('Success');
        } catch (\Throwable $th) {
            return $this->returnErrorRespose($th->getMessage(), 500);
        }
    }
}
