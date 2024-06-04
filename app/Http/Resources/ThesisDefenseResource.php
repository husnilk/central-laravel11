<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ThesisDefenseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'thesis_id' => $this->thesis_id,
            'thesis_rubric_id' => $this->thesis_rubric_id,
            'file_report' => $this->file_report,
            'file_slide' => $this->file_slide,
            'file_journal' => $this->file_journal,
            'status' => $this->status,
            'registered_at' => $this->registered_at,
            'method' => $this->method,
            'trial_at' => $this->trial_at,
            'start_at' => $this->start_at,
            'end_at' => $this->end_at,
            'room_id' => $this->room_id,
            'online_url' => $this->online_url,
            'score' => $this->score,
            'grade' => $this->grade,
            'description' => $this->description,
            'room' => RoomResource::make($this->whenLoaded('room')),
            'thesisDefenseExaminers' => ThesisDefenseExaminerCollection::make($this->whenLoaded('thesisDefenseExaminers')),
        ];
    }
}
