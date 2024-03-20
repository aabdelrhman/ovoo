<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\Api\BaseApiRequest;
use Illuminate\Foundation\Http\FormRequest;

class AgencyRequest extends BaseApiRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'description' => 'nullable|string',
            'photo' => 'nullable|image',
            'admins' => 'array',
            'admins.*' => 'required|integer|exists:users,id',
        ];
    }
}
