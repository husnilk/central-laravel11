<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PeriodResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'year' => $this->year,
            'semester' => $this->semester,
            'active' => $this->active,
            'courseEnrollments' => CourseEnrollmentCollection::make($this->whenLoaded('courseEnrollments')),
        ];
    }
}
