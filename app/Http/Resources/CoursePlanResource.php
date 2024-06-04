<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CoursePlanResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'course_id' => $this->course_id,
            'rev' => $this->rev,
            'code' => $this->code,
            'name' => $this->name,
            'alias_name' => $this->alias_name,
            'credit' => $this->credit,
            'semester' => $this->semester,
            'mandatory' => $this->mandatory,
            'description' => $this->description,
            'ilearn_url' => $this->ilearn_url,
            'validated_by' => $this->validated_by,
            'validated_at' => $this->validated_at,
            'learning_strategy' => $this->learning_strategy,
            'learning_management' => $this->learning_management,
            'participant' => $this->participant,
            'class_observation' => $this->class_observation,
            'constraint' => $this->constraint,
            'improvement' => $this->improvement,
            'classCourses' => ClassCourseCollection::make($this->whenLoaded('classCourses')),
        ];
    }
}
