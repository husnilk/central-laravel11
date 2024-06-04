<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DepartmentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'faculty_id' => $this->faculty_id,
            'abbreviation' => $this->abbreviation,
            'national_code' => $this->national_code,
            'curricula' => CurriculumCollection::make($this->whenLoaded('curricula')),
            'faculty' => FacultyResource::make($this->whenLoaded('faculty')),
        ];
    }
}
