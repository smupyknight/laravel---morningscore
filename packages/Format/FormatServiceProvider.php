<?php

namespace MorningTrain\Foundation\Format;

use Illuminate\Support\ServiceProvider;
use \Closure;

class FormatServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->app->singleton(FormatService::class, function () {
            return new FormatService();
        });
    }

}