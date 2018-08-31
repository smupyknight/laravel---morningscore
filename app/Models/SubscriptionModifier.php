<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubscriptionModifier extends Model
{
    // Relations
    public function modifiable()
    {
        return $this->morphTo();
    }
}
