<?php

namespace App\Context;

use MorningTrain\Foundation\Context\Context;

class AuthContext
{

    public function load()
    {
        $this->configureViews();
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
        Context::views()->from('auth');
    }

}