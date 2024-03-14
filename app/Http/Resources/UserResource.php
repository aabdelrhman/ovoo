<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class UserResource extends JsonResource
{


    protected $includeToken = 0;

    public function __construct($resource, $includeToken = false)
    {
        parent::__construct($resource);
        $this->includeToken = $includeToken;
    }
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
            'email' => $this->email,
            'phone' => $this->phone,
            'user_name' => $this->user_name,
            'date_of_birth' => $this->date_of_birth,
            $this->mergeWhen($this->includeToken == 'useToken', [
                'token' => $this->createToken('api')->plainTextToken,
            ]),
            'provider' => $this->provider,
            'uid' => $this->uid,
            'photo_url' => asset($this->photo_url),
            'background_image' => asset($this->background_image),
            'is_verified' => $this->active == 1 ? true : false,
            'country' => new CountriesResource($this->whenLoaded('country')),
            'interests' => InterestResource::collection($this->whenLoaded('interests')),
            'gender' => $this->gender,
            'is_profile_completed' => $this->is_profile_completed == 1 ? true : false,
            'followers_count' => $this->whenCounted('followers') ?? 0,
            'followings_count' => $this->whenCounted('followings') ?? 0,
            "gifts_send_count" => $this->whenCounted('gift_sents') ?? 0,
            "gifts_received_count" => $this->whenCounted('gift_receiveds') ?? 0,
            'gifts_send' => GiftResource::collection($this->whenLoaded('giftSents'))  ?? null,
            'gifts_received' => GiftResource::collection($this->whenLoaded('giftReceiveds')) ?? null,
            'is_blocked' => $this->is_blocked == 1 ? true : false,
            "rank" => [
                "current_rank" => new RankResource($this->whenLoaded('currentRank')),
                "next_rank" => new RankResource($this->whenLoaded('nextRank')),
                "rank_progress" => 0,
            ],
            "vip_type" => new VipTypeResource($this->whenLoaded('vipType')),
            'is_follow' => $this->when(auth()->user() instanceof \App\Models\User, function () {
                return auth()->user() ? ($this->isFollowing(Auth::user()->id) ? 1 : 0) : 0;
            }),
            'is_blocked_by_me' => $this->when(auth()->user() instanceof \App\Models\User, function () {
                return auth()->user() ? (auth()->user()->isBlocked($this->id) ? 1 : 0) : 0;
            }),
            'is_blocked_by_user' => $this->when(auth()->user() instanceof \App\Models\User, function () {
                return auth()->user() ? (auth()->user()->isBlockedMe($this->id) ? 1 : 0) : 0;
            }),
        ];
    }
}
