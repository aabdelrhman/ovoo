<?php

namespace App\Http\Requests\Api;

use App\Models\GiftType;

class CreateGiftRequest extends BaseApiRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'image' => 'required|image',
            'gift_type_id' => 'required|exists:gift_types,id',
            'is_accepted' => 'required|boolean',
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'gift_type_id' => GiftType::isCustomized()->first()?->id ?? null,
            'is_accepted' => false
        ]);
    }
}
