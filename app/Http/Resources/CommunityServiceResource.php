<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CommunityServiceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'community_service_schema_id' => $this->community_service_schema_id,
            'partner' => $this->partner,
            'start_at' => $this->start_at,
            'fund_amount' => $this->fund_amount,
            'proposal_file' => $this->proposal_file,
            'report_file' => $this->report_file,
            'communityServiceSchema' => CommunityServiceSchemaResource::make($this->whenLoaded('communityServiceSchema')),
            'communityServiceMembers' => CommunityServiceMemberCollection::make($this->whenLoaded('communityServiceMembers')),
        ];
    }
}
