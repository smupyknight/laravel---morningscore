<?php

namespace App\Providers;

use App\Context\AdminContext;
use App\Context\AuthContext;
use App\Context\BaseContext;
use App\Context\PortalContext;
use App\Context\Portal\EnvDataContext;
use App\Context\Portal\SetupContext;
use App\Support\Context\Plugins\EnvData\EnvDataPlugin;
use MorningTrain\Foundation\Context\ContextServiceProvider as ServiceProvider;
use MorningTrain\Foundation\Context\Plugins\Assets\AssetsPlugin;
use MorningTrain\Foundation\Context\Plugins\Breadcrumbs\BreadcrumbsPlugin;
use MorningTrain\Foundation\Context\Plugins\Localization\LocalizationPlugin;
use MorningTrain\Foundation\Context\Plugins\Menus\MenusPlugin;
use MorningTrain\Foundation\Context\Plugins\Meta\MetaPlugin;
use MorningTrain\Foundation\Context\Plugins\Routes\RoutesPlugin;
use MorningTrain\Foundation\Context\Plugins\Translations\TranslationsPlugin;
use MorningTrain\Foundation\Context\Plugins\Views\ViewsPlugin;

class ContextServiceProvider extends ServiceProvider
{

    /**
     * Plugins to load
     *
     * @var array
     */
    protected $plugins = [
        AssetsPlugin::class,
        LocalizationPlugin::class,
        MenusPlugin::class,
        RoutesPlugin::class,
        MetaPlugin::class,
        BreadcrumbsPlugin::class,
        ViewsPlugin::class,
        EnvDataPlugin::class,
    ];

    /**
     * Features to define
     *
     * @var array
     */
    protected $contexts = [
        'base' => BaseContext::class,
        'portal' => PortalContext::class,
        'admin' => AdminContext::class,
        'auth' => AuthContext::class,
        'envdata' => EnvDataContext::class,
        'setup' => SetupContext::class,
    ];

    /**
     * Features to load
     *
     * @var array
     */
    protected $load = [
        'base'
    ];

}
