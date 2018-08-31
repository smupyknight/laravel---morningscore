<?php

namespace App\Support\Util;

use Auth;
use Carbon\Carbon;

class Lang {
    
    public static function handle(){
        
        $langs = config('app.locales', []);
        $default = config('app.locale', 'en');
    
        // Grab from user
        if (Auth::check()) {
            $lang = Auth::user()->lang;
        }
    
        // Grab from cookie
        if ( ! isset($lang) || ! array_key_exists($lang, $langs)) {
            $lang = request()->cookie('lang');
        }
    
        // Grab from browser language
        if ( ! isset($lang) || ! array_key_exists($lang, $langs)) {
            $browser_lang = request()->server('HTTP_ACCEPT_LANGUAGE');
        
            if (is_string($browser_lang)) {
                $lang = substr($browser_lang, 0, strpos($browser_lang, '-'));
            }
        }
    
        // Update user
        if (isset($lang) && Auth::check() && $lang !== Auth::user()->lang) {
            Auth::user()->lang = $lang;
            Auth::user()->save();
        }
    
        $lang = isset($lang) && array_key_exists($lang, $langs) ? $lang : $default;
    
        app()->setLocale($lang);
        Carbon::setLocale($lang);
    
        switch($lang){
            case 'en':
                $lcTime = 'English_United_States';
                break;
            default:
                $lcTime = 'Danish';
                break;
        }
    
        setLocale(LC_TIME, $lcTime);
        
    }
}
