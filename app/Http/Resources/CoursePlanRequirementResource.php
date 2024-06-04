<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CoursePlanRequirementResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'course_plan_id' => $this->course_plan_id,
            'req_course_id' => $this->req_course_id,
            'req_level' => $this->req_level,
        ];
    }
}
