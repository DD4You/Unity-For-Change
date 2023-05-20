<?php

namespace App\Traits;

use Symfony\Component\HttpFoundation\Response;

trait ApiResponseTrait
{
    public function responseOk($data)
    {
        return response()->json([
            'result' => 'success',
            'data' => $data
        ], Response::HTTP_OK);
    }
}
