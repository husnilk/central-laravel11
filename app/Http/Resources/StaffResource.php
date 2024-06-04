<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StaffResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'nik' => $this->nik,
            'name' => $this->name,
            'nip' => $this->nip,
            'karpeg' => $this->karpeg,
            'npwp' => $this->npwp,
            'gender' => $this->gender,
            'birthday' => $this->birthday,
            'birthplace' => $this->birthplace,
            'phone' => $this->phone,
            'address' => $this->address,
            'department_id' => $this->department_id,
            'photo' => $this->photo,
            'marital_status' => $this->marital_status,
            'religion' => $this->religion,
            'association_type' => $this->association_type,
            'status' => $this->status,
        ];
    }
}
