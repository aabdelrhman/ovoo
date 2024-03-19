<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminRequest;
use App\Http\Resources\AdminResource;
use App\Models\Admin;
use App\Traits\ApiResponse;

class ProfileController extends Controller
{
    use ApiResponse;

    public function show()
    {
        try {
            $admin = auth()->user();
            return $this->returnSuccessRespose('Success', new AdminResource($admin));
        } catch (\Throwable $th) {
            return $this->returnErrorRespose($th->getMessage(), 500);
        }
    }


    public function update(AdminRequest $request){
        try {
            $data = $request->validated();
            $admin = Admin::findOrFail(auth()->user()->id);
            if($request->hasFile('photo')){
                $data['photo'] = image_resize_save($request->file('photo'), 'admin'); ;
            }
            $admin->update($data);
            return $this->returnSuccessRespose('Success', new AdminResource($admin));
        } catch (\Throwable $th) {
            return $this->returnErrorRespose($th->getMessage(), 500);
        }
    }
}
