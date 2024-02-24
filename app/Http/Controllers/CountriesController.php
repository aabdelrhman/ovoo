<?php

namespace App\Http\Controllers;

use App\Http\Resources\CountriesResource;
use Illuminate\Http\Request;
use App\Models\Country;
use App\Traits\ApiResponse;

class CountriesController extends Controller
{
    use ApiResponse;
    public function getAllCountries()
    {
        try {
            $countries = CountriesResource::collection(Country::all());
            return $this->returnSuccessRespose('Success', $countries);
        } catch (\Throwable $th) {
            return $this->returnErrorRespose($th->getMessage(), 500);
        }
    }
}
