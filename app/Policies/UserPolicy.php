<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    public function index(User $user)
    {
        return false;
    }

    public function find(User $user, User $target)
    {
        return $user->id === $target->id;
    }

    public function create(User $user)
    {
        return false;
    }

    public function update(User $user, User $target)
    {
        return $user->id === $target->id;
    }

    public function delete(User $user, User $target)
    {
        return false;
    }
}
