<?php

namespace MorningTrain\Foundation\Context\Plugins\Breadcrumbs;

use MorningTrain\Foundation\Context\ContextService;
use MorningTrain\Foundation\Context\Contracts\Pluginable;
use MorningTrain\Foundation\Context\Plugins\Menus\MenusPlugin;

class BreadcrumbsPlugin implements Pluginable
{

    public function register(ContextService $context)
    {
        // Dependencies
        $context->plugin(MenusPlugin::class);

        // Extension
        $context->extend('breadcrumbs', function () {
            return $this->getRegistrar();
        });

    }

    protected $registrar;

    protected function getRegistrar()
    {
        return $this->registrar ?: ($this->registrar = new Registrar());
    }

}