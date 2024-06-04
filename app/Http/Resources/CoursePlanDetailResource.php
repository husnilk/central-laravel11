<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CoursePlanDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'course_plan_id' => $this->course_plan_id,
            'week' => $this->week,
            'course_plan_lo_id' => $this->course_plan_lo_id,
            'grade_indicator' => $this->grade_indicator,
            'grade_criteria' => $this->grade_criteria,
            'media' => $this->media,
            'material' => $this->material,
            'reference' => $this->reference,
            'method' => $this->method,
            'activity' => $this->activity,
            'est_time' => $this->est_time,
            'student_activity' => $this->student_activity,
            'classMeetings' => ClassMeetingCollection::make($this->whenLoaded('classMeetings')),
            'coursePlanLo' => CoursePlanLoResource::make($this->whenLoaded('coursePlanLo')),
        ];
    }
}
