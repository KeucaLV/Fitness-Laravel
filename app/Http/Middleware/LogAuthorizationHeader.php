<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class LogAuthorizationHeader
{
    public function handle(Request $request, Closure $next)
    {
        \Log::info('Authorization Header: ' . $request->header('Authorization'));

        return $next($request);
    }
}
