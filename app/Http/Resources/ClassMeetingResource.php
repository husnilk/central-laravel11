<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ClassMeetingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'meet_no' => $this->meet_no,
            'class_id' => $this->class_id,
            'course_plan_detail_id' => $this->course_plan_detail_id,
            'class_lecturer_id' => $this->class_lecturer_id,
            'material_real' => $this->material_real,
            'assessment_real' => $this->assessment_real,
            'method' => $this->method,
            'ol_platform' => $this->ol_platform,
            'ol_links' => $this->ol_links,
            'room_id' => $this->room_id,
            'meeting_start_at' => $this->meeting_start_at,
            'meeting_end_at' => $this->meeting_end_at,
            'class_course_id' => $this->class_course_id,
            'lecturer_id' => $this->lecturer_id,
            'classAttendances' => ClassAttendanceCollection::make($this->whenLoaded('classAttendances')),
        ];
    }
}
