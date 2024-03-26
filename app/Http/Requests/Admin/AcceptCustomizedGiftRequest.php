<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\Api\BaseApiRequest;
use Illuminate\Foundation\Http\FormRequest;

class AcceptCustomizedGiftRequest extends BaseApiRequest
{
    public function rules(): array
    {
        return [
            'id' => 'required|exists:gifts,id',
            'cost' => 'required|integer|min:0',
        ];
    }
}
