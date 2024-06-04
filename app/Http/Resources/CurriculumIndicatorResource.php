<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CurriculumIndicatorResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'curriculum_plo_id' => $this->curriculum_plo_id,
            'code' => $this->code,
            'indicator' => $this->indicator,
            'min_grade' => $this->min_grade,
            'courseCurriculumIndicators' => CourseCurriculumIndicatorCollection::make($this->whenLoaded('courseCurriculumIndicators')),
            'curriculumPlo' => CurriculumPloResource::make($this->whenLoaded('curriculumPlo')),
        ];
    }
}
