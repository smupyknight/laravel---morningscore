<?php

namespace App\Http\Middleware;

use Closure;

class ForceSSL
{

    public function handle($request, Closure $next)
    {

        if (config('app.use_ssl') && !$request->secure()) {
            return redirect()->secure(url($request->getPathInfo()));
        }

        return $next($request);
    }
}
