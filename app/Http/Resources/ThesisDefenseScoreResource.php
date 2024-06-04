<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ThesisDefenseScoreResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'thesis_defense_examiner_id' => $this->thesis_defense_examiner_id,
            'thesis_rubric_detail_id' => $this->thesis_rubric_detail_id,
            'score' => $this->score,
            'notes' => $this->notes,
            'thesisRubricDetail' => ThesisRubricDetailResource::make($this->whenLoaded('thesisRubricDetail')),
        ];
    }
}
