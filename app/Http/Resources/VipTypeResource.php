<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VipTypeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'image' => asset($this->image),
            'active' => $this->active,
            $this->whenAppended('total_count_identifications' , function () {
                return [
                    'total_count_identifications' => 'ddd',
                ];
            }),
            'price_in_month' => number_format($this->price_in_month, 2, '.', ''),
            'identifications' => IdentificationResource::collection($this->whenLoaded('vipTypeIdentifications')),
            'exclusive_privileges' => ExclusivePrivilegeResource::collection($this->whenLoaded('vipTypeExclusivePrivileges'))
        ];
    }
}
