<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InternshipLogbookResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'internship_id' => $this->internship_id,
            'date' => $this->date,
            'activities' => $this->activities,
            'note' => $this->note,
            'internship' => InternshipResource::make($this->whenLoaded('internship')),
        ];
    }
}
