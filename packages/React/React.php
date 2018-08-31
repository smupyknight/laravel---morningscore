<?php

namespace MorningTrain\Foundation\React;

use Illuminate\Support\Facades\Facade;

class React extends Facade
{

    public static function getFacadeAccessor()
    {
        return ReactService::class;
    }

}