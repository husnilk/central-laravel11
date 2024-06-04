<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CourseEnrollmentDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'course_enrollment_id' => $this->course_enrollment_id,
            'class_id' => $this->class_id,
            'status' => $this->status,
            'in_transcript' => $this->in_transcript,
            'weight' => $this->weight,
            'grade' => $this->grade,
            'class_course_id' => $this->class_course_id,
            'classAttendances' => ClassAttendanceCollection::make($this->whenLoaded('classAttendances')),
        ];
    }
}
