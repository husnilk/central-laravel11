<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ClassProblemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'class_course_id' => $this->class_course_id,
            'course_enrollment_detail_id' => $this->course_enrollment_detail_id,
            'problem' => $this->problem,
            'solution' => $this->solution,
        ];
    }
}
