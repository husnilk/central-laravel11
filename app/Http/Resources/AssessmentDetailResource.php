<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AssessmentDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'course_plan_assessment_id' => $this->course_plan_assessment_id,
            'course_plan_lo_id' => $this->course_plan_lo_id,
            'percentage' => $this->percentage,
            'coursePlanLo' => CoursePlanLoResource::make($this->whenLoaded('coursePlanLo')),
            'assessments' => AssessmentCollection::make($this->whenLoaded('assessments')),
        ];
    }
}
