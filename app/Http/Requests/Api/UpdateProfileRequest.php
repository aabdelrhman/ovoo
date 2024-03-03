<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends BaseApiRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required',
            'gender' => 'required',
            'country_id' => 'required|exists:countries,id',
            'photo' => 'nullable',
            'date_of_birth' => 'nullable|date',
        ];
    }
}
