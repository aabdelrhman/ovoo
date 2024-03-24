<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ChatResource extends JsonResource
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
            'messages' => ChatMessageResource::collection($this->whenLoaded('messages')),
            'users' => UserResource::collection($this->whenLoaded('users')),
            'last_message' =>new ChatMessageResource($this->whenLoaded('lastMessage')) ?? null,
            'count_unread_messages' => $this->unread_messages_count ?? 0 ,
            'created_at' => $this->created_at->toDateTimeString(),

        ];
    }
}
