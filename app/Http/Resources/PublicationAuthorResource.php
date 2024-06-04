<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PublicationAuthorResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'publication_id' => $this->publication_id,
            'user_id' => $this->user_id,
            'position' => $this->position,
            'corresponding' => $this->corresponding,
            'user' => UserResource::make($this->whenLoaded('user')),
        ];
    }
}
