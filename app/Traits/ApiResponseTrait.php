<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait ApiResponseTrait
{
    /**
     * Custom Paginated Response
     *
     * @param mixed $data
     * @return JsonResponse
     */
    public function paginatedResponse(mixed $data): JsonResponse
    {
        return response()->json([
            'status' => true,
            'message' => 'Success',
            'data' => $data->items(),
            'meta' => [
                'total'        => $data->total(),
                'per_page'     => $data->perPage(),
                'current_page' => $data->currentPage(),
                'last_page'    => $data->lastPage(),
                'next_page_url'=> $data->nextPageUrl(),
                'prev_page_url'=> $data->previousPageUrl(),
            ]
        ]);
    }

    /**
     * Server Error Response
     *
     * @return JsonResponse
     */
    public function serverErrorResponse(): JsonResponse
    {
        return response()->json([
            'status' => false,
            'message' => 'Server Error',
            'data' => [],
        ], 500);
    }
}
