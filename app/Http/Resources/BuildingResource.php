<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BuildingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'floors' => $this->floors,
            'build_year' => $this->build_year,
            'rooms' => RoomCollection::make($this->whenLoaded('rooms')),
        ];
    }
}
