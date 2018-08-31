<?php

namespace MorningTrain\Foundation\Context\Middleware;

use \Closure;
use MorningTrain\Foundation\Context\Context;

class LoadFeatures
{

    public function handle($request, Closure $next, ...$features)
    {
        foreach ($features as $feature) {
            Context::load($feature);
        }

        return $next($request);
    }

}