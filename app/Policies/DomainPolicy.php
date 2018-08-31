<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Domain;

class DomainPolicy
{
    public function index(User $user)
    {
        return false;
    }

    public function view(User $user, Domain $domain)
    {
        return $user->hasDomain($domain);
    }

    public function create(User $user)
    {
		return true;
    }

    public function update(User $user, Domain $domain)
    {
        return $user->hasDomain($domain);
    }

    public function delete(User $user, Domain $domain)
    {
        return $user->hasDomain($domain);
    }
}
