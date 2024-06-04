<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CoursePlanLoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'course_plan_id' => $this->course_plan_id,
            'curriculum_indicator_id' => $this->curriculum_indicator_id,
            'code' => $this->code,
            'name' => $this->name,
            'assessmentDetails' => AssessmentDetailCollection::make($this->whenLoaded('assessmentDetails')),
            'coursePlan' => CoursePlanResource::make($this->whenLoaded('coursePlan')),
        ];
    }
}
