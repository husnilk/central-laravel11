<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AssessmentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'assessment_detail_id' => $this->assessment_detail_id,
            'course_enrollment_detail_id' => $this->course_enrollment_detail_id,
            'grade' => $this->grade,
            'courseEnrollmentDetail' => CourseEnrollmentDetailResource::make($this->whenLoaded('courseEnrollmentDetail')),
        ];
    }
}
