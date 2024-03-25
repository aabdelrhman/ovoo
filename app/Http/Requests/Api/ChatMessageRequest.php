<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ChatMessageRequest extends BaseApiRequest
{
    public function rules(): array
    {
        // 0: text, 1: image, 2: audio, 3: video, 4: invitation
        return [
            'chat_id' => 'required',Rule::exists('chat_users')->where(function ($query) {
                $query->where('user_id', auth()->user()->id)->where('chat_id', $this->chat_id);
            }),
            'type' => 'required|in:0, 1, 2, 3, 4',
            'message' => 'exclude_if:type,4|required_unless:type,4',
            'agency_id' => 'exclude_unless:type,4|required_if:type,4',
            'sender_id' => 'required',
        ];
    }


    protected function prepareForValidation(): void
{
    $this->merge([
        'sender_id' => auth()->user()->id,
    ]);
}
}
