<?php

namespace MorningTrain\Foundation\Acl\Traits;

use \Exception;
use Illuminate\Database\Eloquent\Builder;
use MorningTrain\Foundation\Acl\Contracts\Role;

trait Roleable
{

    public function roles()
    {
        throw new Exception('Relationship `roles` must be extended.');
    }

    protected function roleQuery()
    {
        return $this->roles()->getRelated()->newQuery();
    }

    /*
     -------------------------------
     Super
     -------------------------------
     */

    public function scopeSuper(Builder $query)
    {
        return $query->whereHas('roles', function ($query) {
            return $query->super();
        });
    }

    public function isSuper()
    {
        return $this->roles()->super()->exists();
    }

    /*
     -------------------------------
     Roles
     -------------------------------
     */

    public function scopeAssigned($query, $roles)
    {
        foreach ((array)$roles as $role) {
            $slug = $role instanceof Role ? $role->slug : $role;

            $query->whereHas('roles', function ($query) use ($slug) {
                $query
                    ->where('slug', trim($slug))
                    ->orWhereHas('ancestors', function ($query) use ($slug) {
                        return $query->where('slug', $slug);
                    });
            });
        }

        return $query;
    }

    public function scopeNotAssigned($query, $roles)
    {
        foreach ((array)$roles as $role) {
            $slug = $role instanceof Role ? $role->slug : $role;

            $query->whereDoesntHave('roles', function ($query) use ($slug) {
                $query
                    ->where('slug', trim($slug))
                    ->orWhereHas('ancestors', function ($query) use ($slug) {
                        return $query->where('slug', $slug);
                    });
            });
        }

        return $query;
    }

    public function scopeAssignedEither($query, $roles)
    {
        return $query->where(function ($query) use ($roles) {
            foreach ((array)$roles as $role) {
                $slug = $role instanceof Role ? $role->slug : $role;

                $query->orWhereHas('roles', function ($query) use ($slug) {
                    $query
                        ->where('slug', trim($slug))
                        ->orWhereHas('ancestors', function ($query) use ($slug) {
                            return $query->where('slug', $slug);
                        });
                });
            }
        });
    }

    public function assign($roles)
    {
        foreach ((array)$roles as $role) {
            if (!$role instanceof Role) {
                $role = $this->roleQuery()->where('slug', trim($role))->first();
            }

            if (!is_null($role) && ($this->roles()->where('id', $role->id)->count() === 0)) {
                $this->roles()->attach($role->id);
            }
        }
    }

    public function unassign($roles)
    {
        foreach ((array)$roles as $role) {
            if (!$role instanceof Role) {
                $role = $this->roleQuery()->where('slug', trim($role))->first();
            }

            if (!is_null($role)) {
                $this->roles()->detach($role->id);
            }
        }
    }

    public function isAssigned($roles)
    {
        return $this->newQuery()
            ->where($this->getKeyName(), $this->getKey())
            ->assigned($roles)
            ->exists();
    }

    public function isNotAssigned($roles)
    {
        return $this->newQuery()
            ->where($this->getKeyName(), $this->getKey())
            ->notAssigned($roles)
            ->exists();
    }

    public function isAssignedEither($roles)
    {
        return $this->newQuery()
            ->where($this->getKeyName(), $this->getKey())
            ->assignedEither($roles)
            ->exists();
    }

}