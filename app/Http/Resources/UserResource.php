<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

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
            $this->mergeWhen($this->includeToken == 'useToken', [
                'token' => $this->createToken('api')->plainTextToken,
            ]),
            'provider' => $this->provider,
            'uid' => $this->uid,
            'photo_url' => $this->photo_url,
            'is_verified' => $this->active == 1 ? true : false,
            'country' => new CountriesResource($this->whenLoaded('country')),
            'interests' => InterestResource::collection($this->whenLoaded('interests')),
            'gender' => $this->gender,
            'is_profile_completed' => $this->is_profile_completed == 1 ? true : false,
            'followers_count' => $this->followers_count ?? 0,
            'followings_count' => $this->followings_count ?? 0,
            "gift_sents_count" => $this->gift_sents_count ?? 0,
            "gift_receiveds_count" => $this->gift_receiveds_count ?? 0
        ];
    }
}
