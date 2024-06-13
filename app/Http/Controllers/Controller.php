<?php

namespace App\Http\Controllers;

abstract class Controller
{
    public function isnotfound($message = null)
    {
        return [
            'status' => 'success',
            'mesage' => $message ? $message : 'Data not found',
        ];
    }
    //
}
