<?php

namespace MorningTrain\Foundation\Context\Plugins\Routes;

use MorningTrain\Foundation\Context\ContextService;
use MorningTrain\Foundation\Context\Contracts\Pluginable;
use MorningTrain\Foundation\Context\Plugins\Localization\LocalizationPlugin;

class RoutesPlugin implements Pluginable
{

    public function register(ContextService $context)
    {
        // Require dependencies
        $context->plugin(LocalizationPlugin::class);

        // Add localization provider
        $context->localization()->provide('env.router', function () {
            $currentRoute = app()->make('router')->getCurrentRoute();

            return [
                'baseUrl' => url(''),
                'currentUrl' => request()->url(),
                'currentRoute' => isset($currentRoute, $currentRoute->action['as']) ? $currentRoute->action['as'] : null,
                'routes' => $this->getRegistrar()->getRoutesData()
            ];
        });

        // Add registrar
        $context->extend('routes', function (...$arguments) {
            return $this->getRegistrar()->addRoutes(...$arguments);
        });
    }

    protected $registrar;

    protected function getRegistrar()
    {
        return $this->registrar ?: ($this->registrar = new Registrar());
    }

}