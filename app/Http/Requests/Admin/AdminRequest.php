<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\Api\BaseApiRequest;
use Illuminate\Foundation\Http\FormRequest;

class AdminRequest extends BaseApiRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required',
            'phone' => 'required',
            'birth_date' => 'required',
            'photo' => 'nullable',
        ];
    }
}
