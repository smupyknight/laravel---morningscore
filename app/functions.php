<?php
/*
|--------------------------------------------------------------------------
| Global PHP functions
|--------------------------------------------------------------------------
|
|
|
*/

use Illuminate\Support\Facades\Route;

if (!function_exists('isActiveRoute')) {
    function isActiveRoute($routes, $output = 'active')
    {
        if (!is_array($routes)) {
            $routes = [$routes];
        }

        $current = Route::currentRouteName();

        foreach ($routes as $route) {
            if (fnmatch($route, $current)) {
                return $output;
            }
        }
    }
}

if (!function_exists('isActiveUrl')) {
    function isActiveUrl($urls, $output = 'active')
    {
        return request()->is($urls) ? $output : '';
    }
}

if (!function_exists('transOr')) {
    function transOr($id, $params, $default = '')
    {
        if (count(func_get_args()) === 2) {
            if (is_string($params)) {
                $default = $params;
                $params = [];
            }
        }

        $trans = trans($id, $params);

        return $id === $trans ? $default : $trans;
    }
}

if (!function_exists('htmlSrcsetScale')) {
    function htmlSrcsetScale($src, $scale)
    {
        if (!is_string($scale)) {
            return '';
        }

        $location = dirname($src);
        $filenameParts = explode('.', basename($src));
        $filename = array_shift($filenameParts);
        $extension = implode('.', $filenameParts);
        $count = preg_match('/^([0-9]+)x$/', $scale, $matches) ? intval($matches[1]) : 1;
        $sets = [];

        for ($i = 2; $i <= $count; $i++) {
            $sets[] = "{$location}/{$filename}@{$i}x.{$extension} {$i}x";
        }

        return count($sets) > 0 ?
            'srcset="' . implode(', ', $sets) . '"' :
            '';
    }
}