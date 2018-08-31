<?php

namespace App\Support\Context\Plugins\EnvData;

use MorningTrain\Foundation\Context\ContextService;
use MorningTrain\Foundation\Context\Contracts\Pluginable;
use MorningTrain\Foundation\Context\Plugins\Localization\LocalizationPlugin;

class EnvDataPlugin implements Pluginable
{
    protected $domain;

    public function register(ContextService $context)
    {
        $context->plugin(LocalizationPlugin::class);

        $context->extend('envData', function () {
            return $this->getRegistrar();
        });
    }
    
    /**
     * @var Registrar
     */
    protected $registrar;

    protected function getRegistrar()
    {
        return $this->registrar ?: ($this->registrar = new Registrar());
    }

}