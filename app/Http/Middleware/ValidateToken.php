<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\UnauthorizedException;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Facades\JWTAuth;

class ValidateToken
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $this->validateToken();

        return $next($request);
    }

    private function validateToken(): void
    {
        try {
            JWTAuth::parseToken()->authenticate();
        } catch (Exception $e) {
            throw new UnauthorizedException('Invalid token');
        }
    }
}
