<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MedalResource extends JsonResource
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
            'points' => $this->points,
            'medal_type' => $this->whenLoaded('medalType', fn () => $this->medalType->name),
            'earned_at' => Carbon::parse($this->earned_at)->format('d.m.Y'),
            // 'description' => $this->description
        ];
    }
}
