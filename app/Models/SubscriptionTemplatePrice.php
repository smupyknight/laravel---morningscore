<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubscriptionTemplatePrice extends Model
{
    // Relations
    public function subscriptionTemplate()
    {
        return $this->hasMany(SubscriptionTemplate::class);
    }
}
