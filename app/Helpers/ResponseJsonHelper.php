<?php

namespace App\Helpers;

use Illuminate\Http\Response;

class ResponseJsonHelper
{
    public function success($message = null, mixed $data = null, $code = 200)
    {
        return response()->json([
            'error' => false,
            'message' => $message,
            'data' => $data,
            'response' => [
                'code' => $code,
                'status' => Response::$statusTexts[$code],
            ],
        ], $code);
    }

    public function error($message, $code = 400)
    {
        return response()->json([
            'error' => true,
            'message' => $message,
            'response' => [
                'code' => $code,
                'status' => Response::$statusTexts[$code],
            ],
        ], $code);
    }
}
