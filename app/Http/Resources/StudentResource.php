<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StudentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'nik' => $this->nik,
            'nim' => $this->nim,
            'name' => $this->name,
            'year' => $this->year,
            'gender' => $this->gender,
            'birthday' => $this->birthday,
            'birthplace' => $this->birthplace,
            'phone' => $this->phone,
            'address' => $this->address,
            'department_id' => $this->department_id,
            'photo' => $this->photo,
            'marital_status' => $this->marital_status,
            'religion' => $this->religion,
            'status' => $this->status,
            'counselor_id' => $this->counselor_id,
        ];
    }
}
