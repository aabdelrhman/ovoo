<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\Api\BaseApiRequest;

class ResetPasswordRequest extends BaseApiRequest
{
    public function rules(): array
    {
        return [
            'email' => 'required|email|exists:admins,email',
            'code' => 'required',
            'password' => 'required|min:9',
        ];
    }
}
