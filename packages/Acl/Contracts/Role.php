<?php

namespace MorningTrain\Foundation\Acl\Contracts;

use Illuminate\Database\Eloquent\Builder;

interface Role
{
    /**
     * @param Builder $query
     * @return mixed
     */
    public function scopeSuper(Builder $query);

    /**
     * @return bool
     */
    public function isSuper();

}