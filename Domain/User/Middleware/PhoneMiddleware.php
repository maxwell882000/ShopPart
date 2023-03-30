<?php

namespace App\Domain\User\Middleware;

class PhoneMiddleware
{
    public function handle($request, $next)
    {
        if (auth()->user()->isVerified()) {
            return $next($request);
        }
        auth()->user()->sendCode();
        return response()->json([
            'code' => true
        ], 403);
    }
}
