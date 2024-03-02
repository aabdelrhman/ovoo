<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\Api\BaseApiRequest;
use Illuminate\Validation\Rules\Password;

class UserRequest extends BaseApiRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => ['required' ,Password::min(8)->mixedCase()->letters()->symbols()->numbers()],
        ];
    }

}
