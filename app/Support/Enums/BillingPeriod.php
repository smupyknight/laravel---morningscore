<?php

namespace App\Support\Enums;

use App\Support\Util\Enum;

final class BillingPeriod extends Enum
{
    const MONTHLY = 1;
    const QUARTERLY = 2;
    const ANNUAL = 3;
}