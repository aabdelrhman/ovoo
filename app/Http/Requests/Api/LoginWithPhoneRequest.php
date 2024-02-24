<?php

namespace App\Http\Requests\Api;


class LoginWithPhoneRequest extends BaseApiRequest
{
    public function rules(): array
    {
        return [
            'phone' => 'required|min:10|max:15',
            'country_code' => 'required|min:2|max:5',
            'country_flag' => 'required',

        ];
    }
}
