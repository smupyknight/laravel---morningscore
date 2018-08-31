<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Morningscore;

class Company extends Model
{
    /* 
     ------------------------------- 
     Relations 
     ------------------------------- 
     */ 
     
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
    
    public function subscription()
    {
        return $this->hasOne(Subscription::class);
    }
    
    public function domains()
    {
        return $this->belongsToMany(Domain::class);
    }
    
    public function connections()
    {
        return $this->hasMany(Connection::class);
    }

    public function subscriptionModifiers()
    {
        return $this->morphMany(SubscriptionModifier::class, 'modifiable');
    }
    
    /* 
     ------------------------------- 
     Scopes 
     ------------------------------- 
     */ 
     
    public function scopeHasDomain($q, $id)
    {
        return $q->whereHas('domains', function ($q) use ($id) {
            $q->where('id', $id);
        });
    }
     
    public function scopeHasDomainName($q, $domain)
    {
        return $q->whereHas('domains', function ($q) use ($domain) {
            $q->where('domain', $domain);
        });
    }
    
    public function scopeHasUser($q, $id)
    {
        return $q->whereHas('users', function ($q) use ($id) {
            $q->where('id', $id);
        });
    }
    
    public function scopeHasUserAndDomain($q, $user_id, $domain_id)
    {
        return $q->hasUser($user_id)->hasDomain($domain_id);
    }
    
    /* 
     ------------------------------- 
     Accessors 
     ------------------------------- 
     */ 
     
    public function getPriceAttribute()
    {
        // TODO - consider subscription modifiers
        return $this->subscription->subscriptionTemplate
            ->prices()
            ->where('billing_period', $this->subscription->billing_period)
            ->first()->price;
    }
    
    public function getGoogleConnectionAttribute()
    {
        return $this->connections()->service('google')->first();
    }

	public function getAvailableKwsCountAttribute()
	{
		$existing = DomainKeyword::active()->hasCompany($this)->count();
		return $this->possible_kws_count - $existing;
	}

	public function getPossibleKwsCountAttribute()
	{
		// TODO: BETA HARDCODE
		return 1000;
	}
    
	public function getAvailableDomainsCountAttribute()
	{
		$existing = Domain::hasCompany($this)->count();
		return $this->possible_domains_count - $existing;
	}

	public function getPossibleDomainsCountAttribute()
	{
		// TODO: BETA HARDCODE
		return 5;
	}

    /* 
     ------------------------------- 
     Env data helpers 
     ------------------------------- 
     */ 

	public function getEnvData()
	{
        return [
            'id'      => $this->id,
            'name'    => $this->name,
            'country' => $this->country,
            'city'    => $this->city,
            'zipcode' => $this->zipcode,
            'address' => $this->address,
            'phone'   => $this->phone,
            'website' => $this->website,
        ];
	}

	public function getEnvDataDomains()
	{
		return $this->domains()->get()->map(function ($domain, $index) {
			return [
				'id'		=> $domain->id,
				'domain'	=> $domain->domain,
				'locales'	=> $domain->locales()->pluck('id'),
			];
		});
	}
    
    /* 
     ------------------------------- 
     Helpers 
     ------------------------------- 
     */ 
     
    public function isConnectedToGoogle()
    {
        return $this->connections()->service('google')->get()->isNotEmpty();
    }

	public function hasDomainName(string $domain)
	{
		return Domain::where('domain', $domain)->hasCompany($this)->exists();
	}

	public function hasIdenticalDomain(string $domain, Locale $locale)
	{
		return Domain::where('domain', $domain)
			->hasCompany($this)
			->whereHasLocale($locale)
			->exists();
	}

	public function createDomain(string $website, Locale $locale)
	{
		$hostname = Morningscore::checkDomain($website);
		if ($hostname === null || $this->hasIdenticalDomain($hostname, $locale)) {
			return false;
		}

		$domain = Domain::create(['domain' => $website]);

		$domain->locales()->attach($locale->id);
		$this->domains()->attach($domain->id);

		$domain->sync();
		return true;
	}
    
    /* 
     ------------------------------- 
     Static helpers 
     ------------------------------- 
     */ 
     
    public static function setup(User $user, string $website, Locale $locale)
    {
        $company    = self::create();
        $domain     = new Domain(['domain' => $website]);
        
        $hostname = Morningscore::submitDomain($domain, $locale);
        if ($hostname === null) {
            // return error
        } else {
            $domain->domain = $hostname;
            $domain->is_synced = true;
        }
        $domain->save();
        
        $company->domains()->attach($domain->id);
        $domain->locales()->attach($locale->id);
        $user->companies()->attach($company->id);
        return $company;
    }
}
