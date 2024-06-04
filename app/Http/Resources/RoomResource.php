<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RoomResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'building_id' => $this->building_id,
            'name' => $this->name,
            'floor' => $this->floor,
            'number' => $this->number,
            'capacity' => $this->capacity,
            'size' => $this->size,
            'location' => $this->location,
            'public' => $this->public,
            'status' => $this->status,
            'availability' => $this->availability,
            'building' => BuildingResource::make($this->whenLoaded('building')),
        ];
    }
}
