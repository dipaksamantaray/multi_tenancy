<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CentralDomainMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $centralDomains = config('tenancy.central_domains', []);

        // Check if current domain is a central domain
        if (in_array($request->getHost(), $centralDomains)) {
            // Perform actions or prevent access if it's a central domain
            return abort(403, 'Access denied');
        }

        return $next($request);
    }
}
