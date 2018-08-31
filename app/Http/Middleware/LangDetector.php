<?php

namespace App\Http\Middleware;

use App\Support\Util\Lang;
use Carbon\Carbon;
use Illuminate\Http\Request;
use \Closure;
use Illuminate\Support\Facades\Auth;

class LangDetector
{
    
    public function handle(Request $request, Closure $next)
    {
        Lang::handle();

		$response = $next($request);
		$lang = app()->getLocale();
        return $response->cookie('lang', $lang, 120);
    }
    
}

