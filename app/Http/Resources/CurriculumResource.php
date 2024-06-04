<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CurriculumResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'department_id' => $this->department_id,
            'year_start' => $this->year_start,
            'year_end' => $this->year_end,
            'active' => $this->active,
            'description' => $this->description,
            'curriculumBoks' => CurriculumBokCollection::make($this->whenLoaded('curriculumBoks')),
        ];
    }
}
