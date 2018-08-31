<?php

namespace App\Support\Enums;

use App\Support\Util\Enum;
use Illuminate\Support\Facades\Log;

final class SocialiteServiceType extends Enum
{
    const GOOGLE    = 0;
    const FACEBOOK  = 1;
    
    public static function slugToType($slug)
    {
        $slug = strtoupper($slug);
        return defined("self::$slug") ? constant("self::$slug") : null;
    }
}