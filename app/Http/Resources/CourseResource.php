<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CourseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'curriculum_id' => $this->curriculum_id,
            'code' => $this->code,
            'name' => $this->name,
            'alias_name' => $this->alias_name,
            'credit' => $this->credit,
            'semester' => $this->semester,
            'mandatory' => $this->mandatory,
            'description' => $this->description,
            'curriculum' => CurriculumResource::make($this->whenLoaded('curriculum')),
        ];
    }
}
