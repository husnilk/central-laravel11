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

    public function successApiResponse($response, $message = null)
    {
        return response()->json([
            'status' => 'success',
            'message' => $message ? $message : 'Data created successfully',
            'data' => $response,
        ]);
    }

    public function deleteApiResponse($message = null)
    {
        return response()->json([
            'status' => 'success',
            'message' => $message ? $message : 'Data deleted successfully',
        ]);
    }
}
