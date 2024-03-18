<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class BuyCoinsRequest extends BaseApiRequest
{
    public function rules(): array
    {
        return [
            'package_id' => 'required|exists:packages,id',
        ];
    }
}
