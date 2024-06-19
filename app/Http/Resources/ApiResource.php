<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ApiResource extends JsonResource
{
    public mixed $status;

    public mixed $message;

    public function __construct($resource, $status = null, $message = null)
    {
        parent::__construct($resource);
        $this->status = $status;
        $this->message = $message;
    }

    public function responseWithStatus()
    {
        return [
            'status' => $this->status,
            'message' => $this->message,
            'data' => $this->resource,
        ];
    }
}
