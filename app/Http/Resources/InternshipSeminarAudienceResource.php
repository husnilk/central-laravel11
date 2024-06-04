<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InternshipSeminarAudienceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'internship_id' => $this->internship_id,
            'student_id' => $this->student_id,
            'role' => $this->role,
            'question' => $this->question,
            'student' => StudentResource::make($this->whenLoaded('student')),
        ];
    }
}
