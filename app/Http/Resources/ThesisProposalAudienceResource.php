<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ThesisProposalAudienceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'student_id' => $this->student_id,
            'thesis_proposal_id' => $this->thesis_proposal_id,
            'thesisProposal' => ThesisProposalResource::make($this->whenLoaded('thesisProposal')),
        ];
    }
}
