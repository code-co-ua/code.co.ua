<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ServerIpMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        //in_array

        return $next($request);
    }
}
