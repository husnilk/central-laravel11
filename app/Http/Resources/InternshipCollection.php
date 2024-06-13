<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class InternshipCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'status' => 'success',
            'message' => 'Internship data successfully retrieved',
            'data' => $this->collection,
        ];
    }
}
