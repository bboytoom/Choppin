<?php

namespace App\Http\Middleware;

use Closure;

class AuthHeader
{
    public function handle($request, Closure $next)
    {
        $header = $request->header('x-api-key');
        
        if ($header !== config('app.key')) {
            return response(null, 401);
        }

        return $next($request);
    }
}
