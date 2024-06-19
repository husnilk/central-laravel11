<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;

class RoleResource extends ApiResource
{
    public bool $preserveKeys = false;

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        if ($this->status == null || $this->message == null) {
            return [
                'id' => $this->uuid,
                'name' => $this->name,
                'guard_name' => $this->guard_name,
                'permissions' => PermissionResource::collection($this->whenLoaded('permissions')),
            ];
        }

        return $this->responseWithStatus();
    }
}
