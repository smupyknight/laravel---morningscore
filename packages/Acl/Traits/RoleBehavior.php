<?php

namespace MorningTrain\Foundation\Acl\Traits;

use Illuminate\Database\Eloquent\Builder;
use MorningTrain\Foundation\Support\Eloquent\Tree\Tree;

trait RoleBehavior
{
    use Tree;

    protected $nodePathKey = 'node_path';

    /*
     -------------------------------
     Super
     -------------------------------
     */

    public function scopeSuper(Builder $query)
    {
        return $query->where('super', 1);
    }

    public function isSuper()
    {
        return $this->super === 1;
    }

}