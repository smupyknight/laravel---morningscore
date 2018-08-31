<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Company;

class CompanyPolicy
{
    public function index(User $user)
    {
        return false;
    }

    public function find(User $user, Company $company)
    {
        return $user->hasCompany($company);
    }

    public function create(User $user)
    {
        return false;
    }

    public function update(User $user, Company $company)
    {
        return $user->hasCompany($company);
    }

    public function delete(User $user, Company $company)
    {
        return false;
    }
}
