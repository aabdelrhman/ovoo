<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BannerRequest;
use App\Http\Resources\BannerResource;
use App\Models\Banner;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    use ApiResponse;

    public function store(BannerRequest $request){
        try {
            $data = $request->validated();
            if($request->hasFile('image')){
                $data['image'] = image_resize_save($request->file('image'), 'admin'); ;
            }
            $banner = Banner::create($data);
            return $this->returnSuccessRespose('Success',new BannerResource($banner));
        } catch (\Throwable $th) {
            return $this->returnErrorRespose($th->getMessage(), 500);
        }
    }
    public function show($banner){
        try {
            return $this->returnSuccessRespose('Success', new BannerResource(Banner::findOrFail($banner)));
        } catch (\Throwable $th) {
            return $this->returnErrorRespose($th->getMessage(), 500);
        }
    }

    public function update(BannerRequest $request , $banner){
        try {
            $data = $request->validated();
            $banner = Banner::find($banner);
            if($request->hasFile('image')){
                $data['image'] = image_resize_save($request->file('image'), 'admin'); ;
            }
            $banner->update($data);
            return $this->returnSuccessRespose('Success',new BannerResource($banner));
        } catch (\Throwable $th) {
            return $this->returnErrorRespose($th->getMessage(), 500);
        }
    }

    public function destroy ($banner){
        try {
            $banner = Banner::find($banner)->delete();
            return $this->returnSuccessRespose('Success');
        } catch (\Throwable $th) {
            return $this->returnErrorRespose($th->getMessage(), 500);
        }
    }
}
