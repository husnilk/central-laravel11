<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CurriculumBokResource extends JsonResource
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
            'curriculumBokDetails' => CurriculumBokDetailCollection::make($this->whenLoaded('curriculumBokDetails')),
            'curriculum' => CurriculumResource::make($this->whenLoaded('curriculum')),
        ];
    }
}
