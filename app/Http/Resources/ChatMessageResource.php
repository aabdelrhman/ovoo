<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ChatMessageResource extends JsonResource
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
            'type' => $this->type,
            'message' => $this->message,
            'is_me' => $this->sender_id == auth()->user()->id ? true : false,
            'agency' => new AgencyResource($this->whenLoaded('agency')),
            'sender' => new UserResource($this->whenLoaded('sender')),
            'created_at' => Carbon::parse($this->created_at)->diffForHumans()

        ];
    }
}
