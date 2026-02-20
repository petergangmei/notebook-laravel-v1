<?php

if (!function_exists('api_response')) {
    function api_response(
        mixed $data = null,
        string $message = 'Success',
        bool $success = true,
        int $httpStatus = 200
    ): \Illuminate\Http\JsonResponse {
        return response()->json([
            'status' => [
                'status'  => $success ? 'success' : 'error',
                'code'    => $httpStatus,
                'message' => $message,
            ],
            'data'    => $data,
        ], $httpStatus);
    }
}