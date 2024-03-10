<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\Api\BaseApiRequest;

class GiftRequest extends BaseApiRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'image' => 'required|string',
            'cost'=> 'required|numeric',
            'gift_type_id' => 'required|exists:gift_types,id',
        ];
    }
}
