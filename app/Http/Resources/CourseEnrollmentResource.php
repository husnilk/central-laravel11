<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CourseEnrollmentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'student_id' => $this->student_id,
            'period_id' => $this->period_id,
            'counselor_id' => $this->counselor_id,
            'status' => $this->status,
            'mid_term_passcode' => $this->mid_term_passcode,
            'final_term_passcode' => $this->final_term_passcode,
            'registered_at' => $this->registered_at,
            'gpa' => $this->gpa,
            'courseEnrollmentDetails' => CourseEnrollmentDetailCollection::make($this->whenLoaded('courseEnrollmentDetails')),
        ];
    }
}
