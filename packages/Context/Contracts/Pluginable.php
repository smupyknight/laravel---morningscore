<?php

namespace MorningTrain\Foundation\Context\Contracts;

use MorningTrain\Foundation\Context\ContextService;

interface Pluginable
{

    public function register(ContextService $context);

}