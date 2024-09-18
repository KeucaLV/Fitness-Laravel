<?php
namespace App\Http\Middleware;

use Closure;

class Cors
{
    public function handle($request, Closure $next)
    {
        if ($request->getMethod() == "OPTIONS") {
            return response()->json(['status' => 'OK']);
        }

        return $next($request)
            ->header('Access-Control-Allow-Origin', '*') // Allow all origins; adjust as needed
            ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
            ->header('Access-Control-Allow-Headers', 'Origin, Content-Type, Authorization');
    }
}

