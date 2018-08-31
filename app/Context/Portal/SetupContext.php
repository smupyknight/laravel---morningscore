<?php

namespace App\Context\Portal;

use App\Models\Locale;
use MorningTrain\Foundation\Context\Context;

class SetupContext
{
    public function load()
    {
        $this->exportEnvironment();
    }

    /*
     -------------------------------
     Environment
     -------------------------------
     */

    protected function exportEnvironment()
    {
		Context::localize('env.translations', trans('public'));
		Context::localize('env.locales', Locale::getEnvData());
    }
}
