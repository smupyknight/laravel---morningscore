<?php

namespace App\Context;

use MorningTrain\Foundation\Context\Context;
use MorningTrain\Foundation\React\React;

class BaseContext
{

    public function load()
    {
        $this->configureMeta();
        $this->configureReact();
        $this->registerAssets();
    }

    protected function configureMeta()
    {
        // The meta is similar to a repository of
        // variables that we can use in the views
        Context::meta([
            // siteTitle is used in layouts.html to generate the title
            'siteTitle' => config('app.name')
        ]);
    }

    protected function registerAssets()
    {
        Context::stylesheets([
            'https://fonts.googleapis.com/icon?family=Material+Icons'
        ]);

        Context::scripts([
            asset(mix('js/manifest.js')),
            asset(mix('js/vendor.js'))
        ]);
    }

    protected function configureReact()
    {
        React::config([
            'cache' => false,
            'markup' => false,
        ]);
    }
}