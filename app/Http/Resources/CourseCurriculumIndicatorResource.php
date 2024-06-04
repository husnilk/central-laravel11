<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CourseCurriculumIndicatorResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'course_id' => $this->course_id,
            'curriculum_indicator_id' => $this->curriculum_indicator_id,
            'curriculumIndicator' => CurriculumIndicatorResource::make($this->whenLoaded('curriculumIndicator')),
        ];
    }
}
