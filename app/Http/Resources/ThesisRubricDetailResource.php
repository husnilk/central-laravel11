<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ThesisRubricDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'thesis_rubric_id' => $this->thesis_rubric_id,
            'description' => $this->description,
            'percentage' => $this->percentage,
            'thesisRubric' => ThesisRubricResource::make($this->whenLoaded('thesisRubric')),
        ];
    }
}
