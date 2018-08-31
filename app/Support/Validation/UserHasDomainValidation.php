<?php

namespace App\Support\Validation;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use App\Models\Domain;

class UserHasDomainValidation implements Rule
{
    public function __construct($domain = false)
    {
        $this->domain = $domain;
    }

    public function passes($attribute, $value)
    {
        return Auth::user()->hasDomain($value);
    }

    public function message()
    {
        return "User doesn't have access to this domain";
    }

}