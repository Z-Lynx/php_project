<?php

namespace App\Traits;

trait HttpResponses
{
    public function successResponse($data, $message, $code = 200)
    {
        return response()->json([
            'success' => true,
            'data' => $data,
            'statusCode' => $code,
            'message' => $message
        ], $code);
    }

    public function errorResponse($message, $code = 500)
    {
        return response()->json([
            'success' => false,
            'error' => $message,
            'status' => $code,
            'data' => ""
        ], $code);
    }
}