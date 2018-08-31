<?php

namespace App\Support\Validation;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use App\Models\Company;

class UserHasCompanyValidation implements Rule
{
    public function __construct($comp = false)
    {
        $this->comp = $comp;
    }

    public function passes($attribute, $value)
    {
        return Auth::user()->hasCompany($value);
    }

    public function message()
    {
        return "User doesn't have access to this company";
    }

}
