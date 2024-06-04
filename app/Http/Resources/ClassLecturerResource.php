<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ClassLecturerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'class_id' => $this->class_id,
            'lecturer_id' => $this->lecturer_id,
            'position' => $this->position,
            'grading' => $this->grading,
            'class_course_id' => $this->class_course_id,
        ];
    }
}
