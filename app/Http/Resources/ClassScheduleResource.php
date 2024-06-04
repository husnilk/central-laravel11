<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ClassScheduleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'class_id' => $this->class_id,
            'room_id' => $this->room_id,
            'weekday' => $this->weekday,
            'start_at' => $this->start_at,
            'end_at' => $this->end_at,
            'class_course_id' => $this->class_course_id,
        ];
    }
}
