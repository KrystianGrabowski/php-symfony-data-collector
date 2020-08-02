<?php
namespace App\Http;

use Symfony\Component\HttpFoundation\JsonResponse;

class CustomJsonResponse
{
    public function success($data = []): JsonResponse
    {
        return new JsonResponse([
            'status' => "Success",
            'data' => $data
        ], JsonResponse::HTTP_OK);
    }

    public function failure($exception): JsonResponse
    {
        return new JsonResponse([
            'status' => "Failure",
            'code' => $exception->getCode(),
            'message' => $exception->getMessage()
        ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
    }
}

?>