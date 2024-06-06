<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InternshipResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'internship_proposal_id' => $this->internship_proposal_id,
            'student_id' => $this->student_id,
            'advisor_id' => $this->advisor_id,
            'status' => $this->status,
            'start_at' => $this->start_at,
            'end_at' => $this->end_at,
            'report_title' => $this->report_title,
            'seminar_date' => $this->seminar_date,
            'seminar_room_id' => $this->seminar_room_id,
            'link_seminar' => $this->link_seminar,
            'seminar_deadline' => $this->seminar_deadline,
            'attendees_list' => $this->attendees_list,
            'internship_score' => $this->internship_score,
            'activity_report' => $this->activity_report,
            'seminar_note' => $this->seminar_note,
            'work_report' => $this->work_report,
            'certificate' => $this->certificate,
            'report_receipt' => $this->report_receipt,
            'grade' => $this->grade,
            'internshipSeminarAudiences' => InternshipSeminarAudienceCollection::make($this->whenLoaded('internshipSeminarAudiences')),
        ];
    }
}
