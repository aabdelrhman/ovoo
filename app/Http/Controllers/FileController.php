<?php

namespace App\Http\Controllers;

use App\Traits\ApiResponse;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    use ApiResponse;
    public function uploadFile(Request $request)
    {
        try {
            $url = image_resize_save($request->file('file'), 'uploads');
            $data = [
                'domain' => url('/'),
                'path' => $url
            ];
            return $this->returnSuccessRespose('Success', $data, 200);
        } catch (Exception $e) {
            return $this->returnErrorRespose($e->getMessage(), 500);
        }
    }
}
