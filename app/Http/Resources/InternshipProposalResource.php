<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InternshipProposalResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'company_id' => $this->company_id,
            'type' => $this->type,
            'title' => $this->title,
            'job_desc' => $this->job_desc,
            'start_at' => $this->start_at,
            'end_at' => $this->end_at,
            'status' => $this->status,
            'note' => $this->note,
            'active' => $this->active,
            'response_letter' => $this->response_letter,
            'background' => $this->background,
            'internship_company_id' => $this->internship_company_id,
            'internships' => InternshipCollection::make($this->whenLoaded('internships')),
        ];
    }
}
