<?php

namespace App\Exceptions;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TokenException extends \Exception
{
    /**
     * Report the exception.
     */
    public function report(): void
    {
        // ...
    }

    /**
     * Render the exception into an HTTP response.
     */
    public function render(Request $request): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'error' => 'Unauthorized. Invalid Token.',
        ], 400);
    }
}
