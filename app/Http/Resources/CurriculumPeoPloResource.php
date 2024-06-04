<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CurriculumPeoPloResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'curriculum_peo_id' => $this->curriculum_peo_id,
            'curriculum_plo_id' => $this->curriculum_plo_id,
            'curriculumPlo' => CurriculumPloResource::make($this->whenLoaded('curriculumPlo')),
        ];
    }
}
