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
            $banner = Banner::create($request->validated());
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
            $banner = Banner::find($banner);
            $banner->update($request->validated());
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
