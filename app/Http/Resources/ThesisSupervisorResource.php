<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ThesisSupervisorResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'thesis_id' => $this->thesis_id,
            'lecturer_id' => $this->lecturer_id,
            'position' => $this->position,
            'status' => $this->status,
            'created_by' => $this->created_by,
            'thesisLogbooks' => ThesisLogbookCollection::make($this->whenLoaded('thesisLogbooks')),
        ];
    }
}
