<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ThesisSeminarResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'thesis_id' => $this->thesis_id,
            'registered_at' => $this->registered_at,
            'method' => $this->method,
            'seminar_at' => $this->seminar_at,
            'room_id' => $this->room_id,
            'online_url' => $this->online_url,
            'file_report' => $this->file_report,
            'file_slide' => $this->file_slide,
            'file_journal' => $this->file_journal,
            'file_attendance' => $this->file_attendance,
            'recommendation' => $this->recommendation,
            'status' => $this->status,
            'description' => $this->description,
            'room' => RoomResource::make($this->whenLoaded('room')),
            'thesisSeminarReviewers' => ThesisSeminarReviewerCollection::make($this->whenLoaded('thesisSeminarReviewers')),
        ];
    }
}
