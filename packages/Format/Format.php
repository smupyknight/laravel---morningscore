<?php

namespace MorningTrain\Foundation\Format;

use Illuminate\Support\Facades\Facade;

class Format extends Facade
{

    protected static function getFacadeAccessor()
    {
        return FormatService::class;
    }

}