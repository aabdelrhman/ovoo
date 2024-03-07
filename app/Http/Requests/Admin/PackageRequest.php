<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\Api\BaseApiRequest;
use Illuminate\Foundation\Http\FormRequest;

class PackageRequest extends BaseApiRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required',
            'price' => 'required|numeric',
            'coins' => 'required|numeric'
        ];
    }
}
