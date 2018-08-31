<?php

namespace MorningTrain\Foundation\Acl\Contracts;

use Illuminate\Database\Eloquent\Builder;

interface User
{

    /**
     * @return mixed
     */
    public function roles();

    /**
     * @param Builder $query
     * @return mixed
     */
    public function scopeSuper(Builder $query);

    /**
     * @return boolean
     */
    public function isSuper();

    /**
     * @param $query
     * @param $roles
     * @return mixed
     */
    public function scopeAssigned($query, $roles);

    /**
     * @param $query
     * @param $roles
     * @return mixed
     */
    public function scopeNotAssigned($query, $roles);

    /**
     * @param $query
     * @param $roles
     * @return mixed
     */
    public function scopeAssignedEither($query, $roles);

    /**
     * @param $roles
     * @return mixed
     */
    public function assign($roles);

    /**
     * @param $roles
     * @return mixed
     */
    public function unassign($roles);

    /**
     * @param $roles
     * @return boolean
     */
    public function isAssigned($roles);

    /**
     * @param $roles
     * @return boolean
     */
    public function isNotAssigned($roles);

    /**
     * @param $roles
     * @return boolean
     */
    public function isAssignedEither($roles);
}