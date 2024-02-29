<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\Api\BaseApiRequest;

class CountryRequest extends BaseApiRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'code' => 'required|string',
        ];
    }
}
