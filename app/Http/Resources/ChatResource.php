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
            'users' => $this->whenLoaded('users', function () {
                return collect($this->users)->map(function ($user) {
                    return [
                        'id' => $user->id,
                        'name' => $user->name ?? null,
                        'email' => $user->email ?? null,
                        'phone' => $user->phone ?? null, // Include phone with null value if it's null
                        'user_name' => $user->user_name ?? null,
                        'photo_url' => $user->photo_url ?? null,
                        'is_verified' => $user->is_verified ?? 0,
                    ];
                });
            }),
            'last_message' => $this->whenLoaded('lastMessage') ? new ChatMessageResource($this->lastMessage->first()) : null,
            'count_unread_messages' => $this->unread_messages_count ?? 0 ,
            'created_at' => $this->created_at->toDateTimeString(),

        ];
    }
}
