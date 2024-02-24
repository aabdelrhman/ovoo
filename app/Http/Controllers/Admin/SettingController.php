<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    use ApiResponse;
    public function index()
    {
        try {
            $records = Setting::all();
            $formattedData = [];


            foreach ($records as $record) {
                $category = $record->category;
                $key = $record->key;
                $value = $record->value;

                if (!isset($formattedData[$category])) {
                    $formattedData[$category] = [];
                }
                $formattedData[$category][$key] = $value;
            }
            return $this->returnSuccessRespose('Success', $formattedData);
        } catch (\Throwable $th) {
            return $this->returnErrorRespose($th->getMessage() , 500);
        }
    }

    public function update(Request $request){
        try {
            $data = $request->all();
            foreach($data as $key => $value){
                $setting = Setting::where('key', $key)->first();
                if(!is_array($value)){
                    $setting->value = $value;
                    $setting->save();
                }else{
                    $setting->value = json_encode($value);
                    $setting->save();
                }
            }
            return $this->returnSuccessRespose('Success');
        } catch (\Throwable $th) {
            return $this->returnErrorRespose($th->getMessage() , 500);
        }

    }
}
