<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CurriculumPloResource extends JsonResource
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
            'outcome' => $this->outcome,
            'description' => $this->description,
            'min_grade' => $this->min_grade,
            'curriculumPeoPlos' => CurriculumPeoPloCollection::make($this->whenLoaded('curriculumPeoPlos')),
            'curriculum' => CurriculumResource::make($this->whenLoaded('curriculum')),
        ];
    }
}
