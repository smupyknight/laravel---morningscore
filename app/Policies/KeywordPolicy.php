<?php

namespace App\Policies;

use App\Models\User;
use App\Models\DomainKeyword as Keyword;

class KeywordPolicy
{
    public function index(User $user)
    {
        return false;
    }

    public function view(User $user, Keyword $keyword)
    {
        return false;
    }

    public function create(User $user)
    {
        return true;
    }

    public function update(User $user, Keyword $keyword)
    {
        return false;
    }

    public function delete(User $user, Keyword $keyword)
    {
        return $user->hasDomain($keyword->domain);
    }
}
