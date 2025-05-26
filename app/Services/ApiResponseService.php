<?php

namespace App\Services;

use Illuminate\Http\JsonResponse;

class ApiResponseService
{
    /**
     * General API response structure.
     *
     * @param bool $status
     * @param string|null $message
     * @param mixed $data
     * @param mixed $errors
     * @param int $statusCode
     * @return JsonResponse
     */
    public function respond(
        bool $status = true,
        string $message = 'Request successful',
        $data = null,
        $errors = null,
        int $statusCode = 200
    ): JsonResponse {
        $response = [
            'status'  => $status,
            'message' => $message,
            'data'    => $data ?? (object)[],
            'errors'  => $errors ?? (object)[],
        ];

        return response()->json($response, $statusCode);
    }

    /**
     * Shortcut for success responses.
     */
    public function success($data = null, string $message = 'Success', int $statusCode = 200): JsonResponse
    {
        return $this->respond(true, $message, $data, null, $statusCode);
    }

    /**
     * Shortcut for error responses.
     */
    public function error($errors = null, string $message = 'Something went wrong', int $statusCode = 400): JsonResponse
    {
        return $this->respond(false, $message, null, $errors, $statusCode);
    }
}
