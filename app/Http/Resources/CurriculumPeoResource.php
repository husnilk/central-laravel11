<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CurriculumPeoResource extends JsonResource
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
            'profile' => $this->profile,
            'description' => $this->description,
            'curriculumPeoPlos' => CurriculumPeoPloCollection::make($this->whenLoaded('curriculumPeoPlos')),
            'curriculum' => CurriculumResource::make($this->whenLoaded('curriculum')),
        ];
    }
}
