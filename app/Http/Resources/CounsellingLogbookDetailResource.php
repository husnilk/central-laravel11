<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CounsellingLogbookDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'no' => $this->no,
            'counselling_logbook_id' => $this->counselling_logbook_id,
            'user_id' => $this->user_id,
            'description' => $this->description,
        ];
    }
}
