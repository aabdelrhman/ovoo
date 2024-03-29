<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GiftResource extends JsonResource
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
            'image' => asset($this->image),
            'cost' => (int)$this->cost,
            'active' => (int)$this->active,
            'description' => $this->description,
            'category' => new GiftTypesResource($this->whenLoaded('giftType'))
        ];
    }
}
