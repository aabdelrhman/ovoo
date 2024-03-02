<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RoomResource extends JsonResource
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
            'membership_fees' => $this->membership_fees,
            'coins_target' => $this->coins_target,
            'visitors_target' => $this->visitors_target,
            'gifts_target' => $this->gifts_target,
            'level' => new RoomLevelResource($this->whenLoaded('level')),
            'level_background' => new RoomLevelBackgroundResource($this->whenLoaded('levelBackground')),
            'interest' => new InterestResource($this->whenLoaded('interest')),
            'user' => new UserResource($this->whenLoaded('user')),
        ];
    }
}
