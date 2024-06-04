<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CoursePlanMediaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'course_plan_id' => $this->course_plan_id,
            'type' => $this->type,
            'media' => $this->media,
            'coursePlan' => CoursePlanResource::make($this->whenLoaded('coursePlan')),
        ];
    }
}
