<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CoursePlanLecturerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'course_plan_id' => $this->course_plan_id,
            'lecturer_id' => $this->lecturer_id,
            'creator' => $this->creator,
            'lecturer' => LecturerResource::make($this->whenLoaded('lecturer')),
        ];
    }
}
