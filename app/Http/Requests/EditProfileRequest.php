<?php

namespace App\Http\Requests;

use App\Http\Requests\Api\BaseApiRequest;
use Illuminate\Foundation\Http\FormRequest;

class EditProfileRequest extends BaseApiRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'user_name' => 'required',
            'date_of_birth' => 'required|date',
            'country_id' => 'required|exists:countries,id',
            'gender' => 'required',
        ];
    }
}
