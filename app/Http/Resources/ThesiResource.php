<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ThesiResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'topic_id' => $this->topic_id,
            'student_id' => $this->student_id,
            'title' => $this->title,
            'abstract' => $this->abstract,
            'start_at' => $this->start_at,
            'status' => $this->status,
            'grade' => $this->grade,
            'grade_by' => $this->grade_by,
            'created_by' => $this->created_by,
            'thesis_topic_id' => $this->thesis_topic_id,
            'user_id' => $this->user_id,
        ];
    }
}
