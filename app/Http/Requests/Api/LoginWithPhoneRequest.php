<?php

namespace App\Http\Requests\Api;


class LoginWithPhoneRequest extends BaseApiRequest
{
    public function rules(): array
    {
        return [
            'phone' => 'required|min:10|max:15'
        ];
    }
}
