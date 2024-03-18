<?php

namespace App\Http\Controllers;

use App\Http\Requests\Api\BuyCoinsRequest;
use App\Http\Resources\PackageResource;
use App\Models\Package;
use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    use ApiResponse;
    public function index(){
        try {
            $packages = PackageResource::collection(Package::all());
            return $this->returnSuccessRespose('Success', $packages);
        } catch (\Throwable $th) {
            return $this->returnErrorRespose($th->getMessage(), 500);
        }
    }

    public function show($id){
        try {
            $package = new PackageResource(Package::find($id));
            return $this->returnSuccessRespose('Success', $package);
        } catch (\Throwable $th) {
            return $this->returnErrorRespose($th->getMessage(), 500);
        }
    }

    public function buyCoins(BuyCoinsRequest $request){
        try {
            $package = Package::find($request->package_id);
            $user = User::find(auth()->user()->id);
            $user->addToWallet('buy-coins', $package->coins);
            $user->addPiontsToUser($package->points);
            return $this->returnSuccessRespose('Success');
        } catch (\Throwable $th) {
            return $th;
            return $this->returnErrorRespose($th->getMessage(), 500);
        }
    }
}
