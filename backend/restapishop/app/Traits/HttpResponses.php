<?php

namespace App\Traits;

trait HttpResponses
{
    public function successResponse($data, $message, $code = 200, $pagination = null)
    {
        $response = [
            'success' => true,
            'data' => $data,
            'statusCode' => $code,
            'message' => $message,
            'error' => "",
        ];

        if ($pagination != null) {
            $response['pagination'] = [
                'current_page' => $pagination['current_page'],
                'last_page' => $pagination['last_page'],
                'per_page' => $pagination['per_page'],
                'total' => $pagination['total'],
                'next_page_url' => $pagination['next_page_url'],
                'prev_page_url' => $pagination['prev_page_url'],
                'to' => $pagination['to'],
                'from' => $pagination['from'],
            ];
        }

        return response()->json($response, $code);
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