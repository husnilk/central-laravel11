<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CounsellingLogbookResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'student_id' => $this->student_id,
            'counsellor_id' => $this->counsellor_id,
            'counselling_topic_id' => $this->counselling_topic_id,
            'period_id' => $this->period_id,
            'date' => $this->date,
            'status' => $this->status,
            'file' => $this->file,
            'counselling_category_id' => $this->counselling_category_id,
        ];
    }
}
