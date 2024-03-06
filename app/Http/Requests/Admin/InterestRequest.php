<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\Api\BaseApiRequest;

class InterestRequest extends BaseApiRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'active' => 'boolean'
        ];
    }
}
