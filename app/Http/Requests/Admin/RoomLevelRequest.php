<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\Api\BaseApiRequest;
use Illuminate\Foundation\Http\FormRequest;

class RoomLevelRequest extends BaseApiRequest
{
    public function rules(): array
    {
        return [
            'title' => 'required|string'
        ];
    }
}
