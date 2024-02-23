<?php

namespace App\Http\Requests\Api;

use Illuminate\Validation\Rules\Password;

class LoginWithEmailRequest extends BaseApiRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => 'required|email|exists:users',
            // 'password' => ['required' ,Password::min(8)->mixedCase()->letters()->symbols()->numbers()],
            'password' => ['required'],
        ];
    }
}
