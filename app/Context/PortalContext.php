<?php

namespace App\Context;

use MorningTrain\Foundation\Context\Context;
use MorningTrain\Foundation\Context\Plugins\Menus\Menu;
use MorningTrain\Foundation\React\React;

class PortalContext
{

    public function load()
    {
        $this->registerAssets();
        $this->configureViews();
        $this->configureReact();
        $this->exportRoutes();
        $this->registerMenus();
        $this->registerComponents();
        $this->exportEnvironment();
    }

    /*
     -------------------------------
     Assets
     -------------------------------
     */

    protected function registerAssets()
    {
        Context::stylesheets([
            asset(mix('css/portal.css'))
        ]);

        Context::scripts([
            asset(mix('js/portal.js'))
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
        Context::views()->from('portal');
    }

    /*
     -------------------------------
     React
     -------------------------------
     */

    protected function configureReact()
    {
        React::config([
            'namespace' => 'portal'
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
			'portal.home',
            'portal.setup.do',
            'portal.keyword.add',
            'portal.keyword.delete',
            'auth.logout',
            'api.portal.*',
        ]);
    }


    /*
     -------------------------------
     Menus
     -------------------------------
     */

    protected function registerMenus()
    {

    }

    /*
     -------------------------------
     Components
     -------------------------------
     */

    protected function registerComponents()
    {

    }

    /*
     -------------------------------
     Environment
     -------------------------------
     */

    protected function exportEnvironment()
    {
		Context::localize('env.type', config('app.env'));
    }

}
