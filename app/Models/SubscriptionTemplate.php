<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubscriptionTemplate extends Model
{
    protected $casts = [
        'is_default' => 'boolean',
    ];

    // Relations
    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }

    public function prices()
    {
        return $this->hasMany(SubscriptionTemplatePrice::class);
    }
    
    public function features()
    {
        return $this->morphToMany(Feature::class, 'featureable')
            ->withTimestamps()
            ->withPivot('quantity');
    }
}
