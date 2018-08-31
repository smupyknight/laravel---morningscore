<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();
        $this->mapAuthRoutes();
        $this->mapAdminRoutes();
        $this->mapPortalRoutes();
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapPortalRoutes()
    {
        Route::group([
            'middleware' => ['web', 'context:portal'],
            'namespace' => $this->namespace . '\\Portal'

        ], function () {
            require base_path('routes/portal.php');
        });
    }

    /**
     * Maps admin routes
     *
     * @return void
     */
    protected function mapAdminRoutes()
    {
        Route::group([
            'middleware' => ['web', 'auth', 'role:admin', 'context:admin'],
            'prefix' => 'admin',
            'namespace' => $this->namespace . '\\Admin',

        ], function () {
            require base_path('routes/admin.php');
        });
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
            ->middleware('api')
            ->namespace($this->namespace . '\\Api')
            ->group(base_path('routes/api.php'));
    }

    /**
     * Maps auth routes
     *
     * @return void
     */
    public function mapAuthRoutes()
    {
        Route::group([
            'middleware' => ['web', 'context:portal,auth'],
            'namespace' => $this->namespace . '\\Auth',

        ], function () {
            require base_path('routes/auth.php');
        });
    }
}
