<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait ApiResponse
{

    protected function apiResponse($data = null, string $message = '', int $status = 200, array $headers = []): JsonResponse
    {
        $payload = [
            'status'  => $status,
            'message' => $message,
        ];

        if (!is_null($data)) {
            $payload['data'] = $data;
        }

        return response()->json($payload, $status, $headers);
    }

    // Common helpers

    protected function success($data = null, string $message = 'OK', array $headers = []): JsonResponse
    {
        return $this->apiResponse($data, $message, 200, $headers);
    }
    protected function fail($data = null, string $message = 'fail', array $headers = []): JsonResponse
    {
        return $this->apiResponse($data, $message, 400, $headers);
    }


    protected function notFound(string $message = 'Not Found', array $headers = []): JsonResponse
    {
        return $this->apiResponse(null, $message, 404, $headers);
    }
    protected function inValid(string $message = 'inValid', array $headers = []): JsonResponse
    {
        return $this->apiResponse(null, $message, 422, $headers);
    }

    protected function unauthorized(string $message = 'Unauthorized', array $headers = []): JsonResponse
    {
        return $this->apiResponse(null, $message,401, $headers);
    }

    protected function forbidden(string $message = 'Forbidden', array $headers = []): JsonResponse
    {
        return $this->apiResponse(null, $message,403, $headers);
    }

    protected function validationError(array $errors = [], string $message = 'Validation Error', array $headers = []): JsonResponse
    {
        $payload = [
            'status'  => 422,
            'message' => $message,
            'errors'  => $errors,
        ];

        return response()->json($payload, 422, $headers);
    }

    protected function serverError(string $message = 'Server Error', array $headers = [], $exception = null): JsonResponse
    {
        $payload = [
            'status'  => 500,
            'message' => $message,
        ];

        // optionally include exception message in local/dev
        if ($exception && config('app.debug')) {
            $payload['exception'] = (string) $exception;
        }

        return response()->json($payload, 500, $headers);
    }
}
