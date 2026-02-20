<?php

if (!function_exists('api_response')) {
    function api_response(
        mixed $data = null,
        string $message = 'Success',
        bool $success = true,
        int $httpStatus = 200
    ): \Illuminate\Http\JsonResponse {
        if ($success) {
            return response()->json([
                'status' => [
                    'status'  => 'success',
                    'code'    => $httpStatus,
                    'message' => $message,
                ],
                'data'    => $data,
            ], $httpStatus);
        }
        return response()->json([
            'status' => [
                'status'  => 'error',
                'code'    => $httpStatus,
                'message' => $message,
                'errors'  => $data,
            ],
            'data'    => null,
        ], $httpStatus);
    }
}