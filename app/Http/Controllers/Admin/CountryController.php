<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CountryRequest;
use App\Http\Resources\CountriesResource;
use Illuminate\Http\Request;
use App\Models\Country;
use App\Traits\ApiResponse;

class CountryController extends Controller
{
    use ApiResponse;

    public function store(CountryRequest $request){
        try {
            $country = Country::create($request->validated());
            return $this->returnSuccessRespose('Success',new CountriesResource($country));
        } catch (\Throwable $th) {
            return $this->returnErrorRespose($th->getMessage(), 500);
        }
    }
    public function show($country){
        try {
            return $this->returnSuccessRespose('Success', new CountriesResource(Country::findOrFail($country)));
        } catch (\Throwable $th) {
            return $this->returnErrorRespose($th->getMessage(), 500);
        }
    }

    public function update(CountryRequest $request , $country){
        try {
            $country = Country::find($country);
            $country->update($request->validated());
            return $this->returnSuccessRespose('Success',new CountriesResource($country));
        } catch (\Throwable $th) {
            return $this->returnErrorRespose($th->getMessage(), 500);
        }
    }

    public function destroy ($country){
        try {
            $country = Country::find($country)->delete();
            return $this->returnSuccessRespose('Success');
        } catch (\Throwable $th) {
            return $this->returnErrorRespose($th->getMessage(), 500);
        }
    }
}
