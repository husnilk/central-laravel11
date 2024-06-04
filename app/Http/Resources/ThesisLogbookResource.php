<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ThesisLogbookResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'thesis_id' => $this->thesis_id,
            'supervisor_id' => $this->supervisor_id,
            'date' => $this->date,
            'progress' => $this->progress,
            'problem' => $this->problem,
            'file_progress' => $this->file_progress,
            'supervised_by' => $this->supervised_by,
            'supervised_at' => $this->supervised_at,
            'notes' => $this->notes,
            'file_notes' => $this->file_notes,
            'status' => $this->status,
            'thesis_supervisor_id' => $this->thesis_supervisor_id,
        ];
    }
}
