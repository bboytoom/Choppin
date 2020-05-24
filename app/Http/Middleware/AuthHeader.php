<?php

namespace App\Http\Middleware;

use App;
use Closure;

class AuthHeader
{
    public function handle($request, Closure $next)
    {
        $header_key = $request->header('x-api-key');
        $header_language = $request->header('Accept-Language');

        if ($header_key !== config('app.key') || is_null($header_language)) {
            return response(null, 401);
        }

        App::setLocale($header_language);
        return $next($request);
    }
}
