<?php

namespace App\Http\Requests\Api;

use Illuminate\Support\Facades\Password;

class SignUpWithEmailRequest extends BaseApiRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => 'required|email|unique:users',
            'password' => ['required' ,Password::min(8)->mixedCase()->letters()->symbols()->numbers()],
        ];
    }
}
