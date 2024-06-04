<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ClassCourseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'course_id' => $this->course_id,
            'period_id' => $this->period_id,
            'course_plan_id' => $this->course_plan_id,
            'name' => $this->name,
            'course_code' => $this->course_code,
            'course_name' => $this->course_name,
            'course_credits' => $this->course_credits,
            'course_semester' => $this->course_semester,
            'meeting_nonconformity' => $this->meeting_nonconformity,
            'meeting_verified' => $this->meeting_verified,
            'course' => CourseResource::make($this->whenLoaded('course')),
            'classMeetings' => ClassMeetingCollection::make($this->whenLoaded('classMeetings')),
        ];
    }
}
