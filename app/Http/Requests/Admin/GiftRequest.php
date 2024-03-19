<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\Api\BaseApiRequest;

class GiftRequest extends BaseApiRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'image' => 'nullable',
            'cost'=> 'required|numeric',
            'gift_type_id' => 'required|exists:gift_types,id',
            'active' => 'nullable|boolean',
            'description' => 'nullable|string',
        ];
    }
}
