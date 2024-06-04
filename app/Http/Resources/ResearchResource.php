<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ResearchResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'research_schema_id' => $this->research_schema_id,
            'start_at' => $this->start_at,
            'fund_amount' => $this->fund_amount,
            'proposal_file' => $this->proposal_file,
            'report_file' => $this->report_file,
            'researchSchema' => ResearchSchemaResource::make($this->whenLoaded('researchSchema')),
            'researchMembers' => ResearchMemberCollection::make($this->whenLoaded('researchMembers')),
        ];
    }
}
