<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AssessmentRubricResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'assessment_criteria_id' => $this->assessment_criteria_id,
            'rubric' => $this->rubric,
            'grade' => $this->grade,
            'assessmentCriteria' => AssessmentCriteriaResource::make($this->whenLoaded('assessmentCriteria')),
        ];
    }
}
