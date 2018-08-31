<?php

namespace MorningTrain\Foundation\Context\Plugins\Translations;

use MorningTrain\Foundation\Context\Context;
use MorningTrain\Foundation\Context\ContextService;
use MorningTrain\Foundation\Context\Contracts\Pluginable;
use MorningTrain\Foundation\Context\Plugins\Localization\LocalizationPlugin;

class TranslationsPlugin implements Pluginable
{

    public function register(ContextService $context)
    {
        // Require dependencies
        $context->plugin(LocalizationPlugin::class);

        // Add exporter
        $context->extend('translations', function (...$arguments) {
            $this->exportTranslations(...$arguments);
        });
    }

    protected function exportTranslations(array $translations)
    {
        $data = [];

        foreach ($translations as $key) {
            $data[$key] = trans($key);
        }

        Context::localize('env.trans', $data);
    }

}