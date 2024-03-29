<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BannerResource extends JsonResource
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
            'title' => $this->title,
            'image' => asset($this->image),
            'url' => $this->url,
            'create_at' => Carbon::parse($this->created_at)->format('F j, Y'),
            "status" => $this->status
        ];
    }
}
