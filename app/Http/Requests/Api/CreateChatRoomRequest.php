<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class CreateChatRoomRequest extends BaseApiRequest
{
    public function rules(): array
    {
        return [
            'users' => 'required|array',
            'users.*' => 'required|exists:users,id',
        ];
    }
}
