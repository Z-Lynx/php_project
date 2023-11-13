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
            'message' => $message,
            'error' => "",
        ], $code);
    }

    public function errorResponse($message, $code = 500, $error = '')
    {
        return response()->json([
            'success' => false,
            'data' => "",
            'statusCode' => $code,
            'message' => $message,
            'error' => $error,
        ], $code);
    }
}