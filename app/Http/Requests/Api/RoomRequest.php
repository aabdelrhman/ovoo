<?php

namespace App\Http\Requests\Api;

use App\Models\RoomLevelBackground;
use Illuminate\Foundation\Http\FormRequest;

class RoomRequest extends BaseApiRequest
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
            'name' => 'required|string',
            'membership_fees' => 'required|integer',
            'level_id' => 'required|exists:room_levels,id',
            'level_background_id' => 'required|exists:room_level_backgrounds,id',
            'interest_id' => 'required|exists:interests,id',
            'coins_target' => 'integer',
            'visitors_target' => 'integer',
            'gifts_target' => 'integer',
        ];
    }

    // public function prepareForValidation(){

    //     $this->merge([
    //         'level_background_id' => RoomLevelBackground::where('level_id', $this->level_id)->first()->id
    //     ]);
    // }
}
