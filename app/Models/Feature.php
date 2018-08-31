<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    protected $casts = [
        'is_public' => 'boolean',
    ];
    
    protected $hidden = [
        'pivot',
    ];
    
    protected $appends = [
        'quantity',
    ];

    // Relations
    public function subscriptions()
    {
        return $this->morphedByMany(Subscription::class, 'featureable')
            ->withTimestamps()
            ->withPivot('quantity');
    }
    
    public function subscriptionTemplates()
    {
        return $this->morphedByMany(SubscriptionTemplate::class, 'featureable')
            ->withTimestamps()
            ->withPivot('quantity');
    }
    
    // Scopes
    public function scopePublic($q)
    {
        return $q->where('is_public', 1);
    }
    
    // Accessors
    public function getQuantityAttribute()
    {
        if($this->pivot !== null) {
            return (float)$this->pivot->quantity;
        }
        return null;
    }
}
