<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ThesisSeminarReviewerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'thesis_seminar_id' => $this->thesis_seminar_id,
            'reviewer_id' => $this->reviewer_id,
            'status' => $this->status,
            'position' => $this->position,
            'recommendation' => $this->recommendation,
            'notes' => $this->notes,
            'lecturer_id' => $this->lecturer_id,
        ];
    }
}
