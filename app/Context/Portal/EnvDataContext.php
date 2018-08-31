<?php

namespace App\Context\Portal;

use MorningTrain\Foundation\Context\Context;
use App\Support\Context\Plugins\EnvData\EnvDataPlugin;

class EnvDataContext
{
    public function load()
    {
        Context::plugin(EnvDataPlugin::class);
        $request = request();
        $domain_id = $request->input('domain');
        
        Context::envData()->domain($domain_id);
        Context::envData()->export();
    }
}
