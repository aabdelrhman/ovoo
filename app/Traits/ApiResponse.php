<?php

namespace App\Traits;

trait ApiResponse
{
    public function returnSuccessRespose($message = 'Success', $data = null, $statusCode = 200)
    {
        return response()->json([
            "message" => $message,
            'code' => $statusCode,
            "data" => $data,
        ], $statusCode);
    }

    public function returnSuccessResposeWIthPaginate($message = 'Success', $data = null, $statusCode = 200)
    {
        if($data)
        return response()->json([
            "message" => $message,
            'code' => $statusCode,
            "data" => $data,
            'meta' => [
                'total' => $data->total(),
                'currentPage' => $data->currentPage(),
                'lastPage' => $data->lastPage(),
                'perPage' => $data->perPage(),
            ],
            'links' => [
                'first' => $data->url(1),
                'last' => $data->url($data->lastPage()),
                'prev' => $data->previousPageUrl(),
                'next' => $data->nextPageUrl(),
            ],
        ], $statusCode);
    }

    public function returnErrorRespose($message = 'Error', $statusCode = 500)
    {
        return response()->json([
            "message" => $message,
            'code' => $statusCode
        ], $statusCode);
    }



}
