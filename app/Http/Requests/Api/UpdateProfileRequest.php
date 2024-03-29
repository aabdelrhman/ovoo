<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends BaseApiRequest
{
    public function rules(): array
    {
        return [
            'name' => 'nullable',
            'gender' => 'nullable',
            'country_id' => 'nullable|exists:countries,id',
            'photo' => 'nullable',
            'date_of_birth' => 'nullable|date',
            'background_image' => 'nullable',
        ];
    }
}
