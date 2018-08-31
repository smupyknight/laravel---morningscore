<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BaseDomain extends Model
{
    protected $table = 'domains';
    
    public function getForeignKey()
    {
        return 'domain_id';
    }
    
    protected $casts = [
            'active' => 'boolean',
            'is_synced' => 'boolean',
    ];

    protected $fillable = [
        'domain',
        'is_synced',
    ];

    /* 
     ------------------------------- 
     Relations 
     ------------------------------- 
     */ 
     
    public function companies()
    {
        return $this->belongsToMany(Company::class);
    }
    
    public function locales()
    {
        return $this->belongsToMany(Locale::class, 'domain_locale');
    }
    
    public function keywords()
    {
        return $this->hasMany(DomainKeyword::class);
    }
    
    public function googleConnectionParameters()
    {
        return $this->hasMany(ConnectionParameter::class)->whereHas('connection', function ($q) {
            $q->service('google');
        });
    }
    
    /* 
     ------------------------------- 
     Helpers 
     ------------------------------- 
     */ 
     
    public function hasGoogleAnalyticsView()
    {
        return $this->googleConnectionParameters()->where('parameter_key', '=', 'view_id')->first() !== null;
    }
}
