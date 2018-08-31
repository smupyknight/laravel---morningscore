<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use MorningTrain\Foundation\Acl\Contracts\Role as RoleContract;
use MorningTrain\Foundation\Acl\Traits\RoleBehavior;

class Role extends Model implements RoleContract
{
    use RoleBehavior;

    /*
     -------------------------------
     Relationships
     -------------------------------
     */

    public function users()
    {
        return $this->morphedByMany(User::class, 'roleable');
    }

}