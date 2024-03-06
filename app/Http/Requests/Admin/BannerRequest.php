<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\Api\BaseApiRequest;
use Illuminate\Foundation\Http\FormRequest;

class BannerRequest extends BaseApiRequest
{
    public function rules(): array
    {
        return [
            'title' => 'nullable',
            'image' => 'required',
            'url' => 'nullable',
            'status' => 'nullable|in:1,0'
        ];
    }
}
