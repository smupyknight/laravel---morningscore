<?php

namespace App\Support\Validation;

use Illuminate\Contracts\Validation\Rule;
use Morningscore;

class CheckDomainValidation implements Rule
{
    public function __construct($domain = false)
    {
        $this->domain = $domain;
    }

    public function passes($attribute, $value)
    {
		return Morningscore::checkDomain($value) ? true : false;
    }

    public function message()
    {
        return "This domain doesn't exist";
    }

}
