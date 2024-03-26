<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class SentGiftRequest extends BaseApiRequest
{
    public function rules(): array
    {
        return [
            'gift_id' => 'required|exists:gifts,id',
            'room_id' => 'required|exists:rooms,id',
            'gift_count' => 'required|integer|min:1',
        ];
    }
}
