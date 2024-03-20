<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AgencyResource extends JsonResource
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
            'photo' => asset($this->photo),
            'users' => $this->whenLoaded('users', fn () => UserResource::collection($this->users)),
            'admins' => $this->whenLoaded('admins', fn () => UserResource::collection($this->admins)),
        ];
    }
}
