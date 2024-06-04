<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CoursePlanReferenceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'course_plan_id' => $this->course_plan_id,
            'title' => $this->title,
            'author' => $this->author,
            'publisher' => $this->publisher,
            'year' => $this->year,
            'type' => $this->type,
            'primary' => $this->primary,
            'coursePlan' => CoursePlanResource::make($this->whenLoaded('coursePlan')),
        ];
    }
}
