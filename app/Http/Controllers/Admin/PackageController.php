<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PackageRequest;
use App\Http\Resources\PackageResource;
use App\Models\Package;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    use ApiResponse;

    public function index(){
        try {
            return $this->returnSuccessRespose('Success',PackageResource::collection(Package::all()));
        } catch (\Throwable $th) {
            return $this->returnErrorRespose($th->getMessage(), 500);
        }
    }

    public function store(PackageRequest $request){
        try {
            $package = Package::create($request->validated());
            return $this->returnSuccessRespose('Success',new PackageResource($package));
        } catch (\Throwable $th) {
            return $this->returnErrorRespose($th->getMessage(), 500);
        }
    }
    public function show($package){
        try {
            return $this->returnSuccessRespose('Success', new PackageResource(Package::findOrFail($package)));
        } catch (\Throwable $th) {
            return $this->returnErrorRespose($th->getMessage(), 500);
        }
    }

    public function update(PackageRequest $request , $package){
        try {
            $package = Package::find($package);
            $package->update($request->validated());
            return $this->returnSuccessRespose('Success',new PackageResource($package));
        } catch (\Throwable $th) {
            return $this->returnErrorRespose($th->getMessage(), 500);
        }
    }

    public function destroy ($package){
        try {
            $package = Package::find($package)->delete();
            return $this->returnSuccessRespose('Success');
        } catch (\Throwable $th) {
            return $this->returnErrorRespose($th->getMessage(), 500);
        }
    }
}
