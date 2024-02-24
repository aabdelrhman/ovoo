<?php

namespace App\Http\Requests\Api;

use Illuminate\Validation\Rules\Password;

class SocialAuthRequest extends BaseApiRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => 'required|email',
            'uid' => 'required',
            'provider' => 'required',
            'name' => 'required',
            'firebase_id_token' => 'required',
            'photo_url' => '',
            'nonce' => 'required',
        ];
    }
}
