<?php

namespace App\Http\Controllers;

abstract class Controller
{
    public function isnotfound($message = null)
    {
        return [
            'status' => 'failed',
            'message' => $message ? $message : 'Data not found',
        ];
    }
    //
}
