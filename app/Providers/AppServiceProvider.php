<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use App\Services\Google;
use App\Services\Morningscore;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (config('app.use_ssl')) {
            \URL::forceScheme('https');
        }
        // Fix database `key to long` error
        Schema::defaultStringLength(191);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->alias('bugsnag.multi', \Illuminate\Contracts\Logging\Log::class);
        $this->app->alias('bugsnag.multi', \Psr\Log\LoggerInterface::class);
        $this->app->singleton('google', function ($app) {
            return new Google();
        });
        $this->app->singleton('morningscore', function ($app) {
            return new Morningscore();
        });
    }
}
