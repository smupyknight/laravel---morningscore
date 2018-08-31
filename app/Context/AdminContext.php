<?php

namespace App\Context;

use MorningTrain\Foundation\Context\Context;
use MorningTrain\Foundation\Context\Plugins\Menus\Menu;
use MorningTrain\Foundation\React\React;

class AdminContext
{

    public function load()
    {
        $this->registerAssets();
        $this->configureViews();
        $this->configureReact();
        $this->exportRoutes();
        $this->registerMenus();
        $this->configureBreadcrumbs();
        $this->registerComponents();
    }

    /*
     -------------------------------
     Assets
     -------------------------------
     */

    protected function registerAssets()
    {
        Context::stylesheets([
            asset(mix('css/admin.css'))
        ]);

        Context::scripts([
            asset(mix('js/admin.js'))
        ]);
    }

    /*
     -------------------------------
     Views
     -------------------------------
     */

    protected function configureViews()
    {
        // Specify where to load the views from (with a prefix)
        // Context::views()->prefix('contexts.admin.');

        // OR:
        // Specify a context (prefix will be generated as $context.)
        Context::views()->from('admin');
    }

    /*
     -------------------------------
     React
     -------------------------------
     */

    protected function configureReact()
    {
        React::config([
            'namespace' => 'admin'
        ]);
    }

    /*
     -------------------------------
     Routes
     -------------------------------
     */

    protected function exportRoutes()
    {
        Context::routes([
            'api.*'
        ]);
    }


    /*
     -------------------------------
     Menus
     -------------------------------
     */

    protected function registerMenus()
    {
        Context::menu('sidebar', function (Menu $menu) {
            $menu->item('Dashboard', 'admin.dashboard', ['icon' => 'dashboard']);
        });
    }

    /*
     -------------------------------
     Breadcrumbs
     -------------------------------
     */

    protected function configureBreadcrumbs()
    {
        // Specify which menus should be queried
        // when generating breadcrumbs
        // NOTE: The order of the menus is important as
        // the first one found is used
        Context::breadcrumbs()->from([
            'sidebar'
        ]);
    }

    /*
     -------------------------------
     Components
     -------------------------------
     */

    protected function registerComponents()
    {

    }

}