<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CoursePlanDetailActivityResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'course_plan_detail_id' => $this->course_plan_detail_id,
            'activity' => $this->activity,
            'method' => $this->method,
            'est_time' => $this->est_time,
            'student_activity' => $this->student_activity,
            'coursePlanDetail' => CoursePlanDetailResource::make($this->whenLoaded('coursePlanDetail')),
        ];
    }
}
