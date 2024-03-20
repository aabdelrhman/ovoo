<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AgencyRequest;
use App\Http\Resources\AgencyResource;
use App\Models\Agency;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class AgencyController extends Controller
{
    use ApiResponse;

    public function index(){
        try {
            return $this->returnSuccessRespose('Success',AgencyResource::collection(Agency::with('users' , 'admins')->get()));
        } catch (\Throwable $th) {
            return $this->returnErrorRespose($th->getMessage(), 500);
        }
    }

    public function show($agency){
        try {
            return $this->returnSuccessRespose('Success',new AgencyResource(Agency::with('users' , 'admins')->find($agency)));
        } catch (\Throwable $th) {
            return $this->returnErrorRespose($th->getMessage(), 500);
        }
    }


    public function store(AgencyRequest $request){
        try {
            $data = $request->except('admins');
            if($request->hasFile('photo')){
                $data['photo'] = image_resize_save($request->file('photo'), 'agencies'); ;
            }
            $agency = Agency::create($data);
            if ($agency) {
                $agency->users()->attach($request->admins, ['is_admin' => 1]);
                return $this->returnSuccessRespose('Success', new AgencyResource($agency));
            } else {
                return $this->returnErrorRespose('Failed to create agency', 500);
            }
        } catch (\Throwable $th) {
            return $this->returnErrorRespose($th->getMessage(), 500);
        }
    }
}
