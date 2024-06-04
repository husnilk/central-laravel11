<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AssessmentCriterionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'assessment_detail_id' => $this->assessment_detail_id,
            'criteria' => $this->criteria,
            'method' => $this->method,
            'assessmentDetail' => AssessmentDetailResource::make($this->whenLoaded('assessmentDetail')),
            'assessmentRubrics' => AssessmentRubricCollection::make($this->whenLoaded('assessmentRubrics')),
        ];
    }
}
