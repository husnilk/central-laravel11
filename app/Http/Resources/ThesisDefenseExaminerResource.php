<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ThesisDefenseExaminerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'thesis_defense_id' => $this->thesis_defense_id,
            'examiner_id' => $this->examiner_id,
            'status' => $this->status,
            'position' => $this->position,
            'notes' => $this->notes,
            'lecturer_id' => $this->lecturer_id,
            'thesisDefenseScores' => ThesisDefenseScoreCollection::make($this->whenLoaded('thesisDefenseScores')),
        ];
    }
}
