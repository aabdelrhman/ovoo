<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AdminResource extends JsonResource
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
            'role' => $this->roles()->first()?->name,
            'permissions' => $this->getAllPermissions()->pluck('name')->toArray(),
            $this->mergeWhen($this->includeToken, [
                'token' => $this->createToken('admin')->plainTextToken,
            ]),
        ];
    }
}
