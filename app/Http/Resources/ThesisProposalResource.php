<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ThesisProposalResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'thesis_id' => $this->thesis_id,
            'datetime' => $this->datetime,
            'room_id' => $this->room_id,
            'grade' => $this->grade,
            'graded_by' => $this->graded_by,
            'status' => $this->status,
            'file_proposal' => $this->file_proposal,
            'user_id' => $this->user_id,
            'thesisProposalAudiences' => ThesisProposalAudienceCollection::make($this->whenLoaded('thesisProposalAudiences')),
        ];
    }
}
