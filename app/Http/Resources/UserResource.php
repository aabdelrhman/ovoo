<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{


    protected $includeToken;

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
            $this->mergeWhen($this->includeToken, [
                'token' => $this->createToken('api')->plainTextToken,
            ]),
            'provider' => $this->provider,
            'uid' => $this->uid,
            'photo_url' => $this->photo_url,
            'is_verified' => $this->active == 1 ? true : false,
            'country' => $this->whenLoaded('country', new CountriesResource($this->country)),
            'interests' => InterestResource::collection($this->whenLoaded('interests')),
            'gender' => $this->gender,
            'is_profile_completed' => $this->is_profile_completed == 1 ? true : false,
        ];
    }
}
