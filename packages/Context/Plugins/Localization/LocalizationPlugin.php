<?php

namespace MorningTrain\Foundation\Context\Plugins\Localization;

use MorningTrain\Foundation\Context\ContextService;
use MorningTrain\Foundation\Context\Contracts\Pluginable;

class LocalizationPlugin implements Pluginable
{

    protected $registrar;

    public function register(ContextService $context)
    {
        $context->extend('localization', function () {
            return $this->getRegistrar();
        });

        $context->extend('localize', function ($key, $value) {
            return $value instanceof \Closure ?
                $this->getRegistrar()->provide($key, $value) :
                $this->getRegistrar()->localize($key, $value);
        });
    }

    protected function getRegistrar()
    {
        return $this->registrar ?: ($this->registrar = new Registrar());
    }

}