<?php

namespace App\Traits;

use Symfony\Component\HttpFoundation\JsonResponse;

trait ApiResponseTrait
{
    /**
     * Returns a JSON response with the specified data.
     *
     * @param array $data The data to return in the response.
     * @param int $status
     * @param array $headers
     * @return JsonResponse
     */
    public function apiResponse(string $message, array $data, int $status = 200, array $headers = []): JsonResponse
    {
        $response = [
            'success' => true,
            'message' => $message,
            'data' => $data,
            'count' => is_countable($data) ? count($data) : 0
        ];

        return new JsonResponse($response, $status, $headers);
    }


    /**
     * Returns a JSON response with the given error message.
     *
     * @param string $message The error message to be returned in the response.
     * @param int $status The HTTP status code of the response.
     * @param array $headers Additional headers to be set in the response.
     *
     * @return JsonResponse The JSON response object.
     */
    public function apiErrorResponse(string $message, int $status = 400, array $headers = []): JsonResponse
    {
        $response = [
            'success' => false,
            'message' => $message
        ];

        return new JsonResponse($response, $status, $headers);
    }
}
