<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PublicationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'publisher_id' => $this->publisher_id,
            'published_at' => $this->published_at,
            'file' => $this->file,
            'publisher' => PublisherResource::make($this->whenLoaded('publisher')),
        ];
    }
}
