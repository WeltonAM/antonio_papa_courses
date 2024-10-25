<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ScopeAmbassadorMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!$request->user() || !$request->user()->tokenCan('ambassador')) {
            abort(401, 'Unauthorized');
        }

        return $next($request);
    }
}
