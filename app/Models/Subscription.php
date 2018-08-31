<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    protected $fillable = [
        'company_id', 'subscription_template_id', 'billing_period', 'subscription_id'
    ];

    // Relations
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
    
    public function subscriptionTemplate()
    {
        return $this->belongsTo(SubscriptionTemplate::class);
    }
    
    public function features()
    {
        return $this->morphToMany(Feature::class, 'featureable')
        ->withTimestamps()
        ->withPivot('quantity');
    }
    
    public function subscriptionModifiers()
    {
        return $this->morphMany(SubscriptionModifier::class, 'modifiable');
    }
}
