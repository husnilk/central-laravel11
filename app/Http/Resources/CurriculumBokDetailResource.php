<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CurriculumBokDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'curriculum_bok_id' => $this->curriculum_bok_id,
            'lo' => $this->lo,
            'curriculumBok' => CurriculumBokResource::make($this->whenLoaded('curriculumBok')),
        ];
    }
}
