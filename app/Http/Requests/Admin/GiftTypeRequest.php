<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\Api\BaseApiRequest;
class GiftTypeRequest extends BaseApiRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string',
        ];
    }
}
