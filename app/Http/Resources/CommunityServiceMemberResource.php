<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CommunityServiceMemberResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'community_service_id' => $this->community_service_id,
            'position' => $this->position,
            'communityService' => CommunityServiceResource::make($this->whenLoaded('communityService')),
        ];
    }
}
