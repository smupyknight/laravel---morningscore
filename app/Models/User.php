<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use MorningTrain\Foundation\Acl\Contracts\User as UserContract;
use MorningTrain\Foundation\Acl\Traits\Roleable;
use Illuminate\Support\Facades\Mail;
use App\Mails\Auth\ResetPasswordMail;
use App\Events\UserCreated;

class User extends Authenticatable implements UserContract
{
    use Notifiable;
    use HasApiTokens;
    use Roleable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'nickname', 'email', 'password', 'avatar', 'lang',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

	/**
     * The event map for the model.
     *
     * @var array
     */
    protected $dispatchesEvents = [
        'created' => UserCreated::class,
    ];

    /*
     -------------------------------
     Relationships
     -------------------------------
     */

    public function roles()
    {
        return $this->morphToMany(Role::class, 'roleable');
    }
    
    public function companies()
    {
        return $this->belongsToMany(Company::class);
    }
    
    public function userTokens()
    {
        return $this->hasMany(UserToken::class);
    }
    
    public function viralLoops()
    {
        return $this->hasMany(ViralLoopsUser::class);
    }
    
    public function rewards()
    {
        return $this->hasManyThrough(ViralLoopsReward::class, ViralLoopsUser::class);
    }

	public function emailAttempts()
	{
		return $this->hasMany(EmailAttempt::class);
	}
    /*
     -------------------------------
     Accessors & Mutators
     -------------------------------
     */
     
    public function getNameAttribute()
    {
        return trim($this->first_name . " " . $this->last_name);
    }
    
    public function getFallbackDomainAttribute()
    {
        return Domain::whereHas('companies.users', function ($q) {
                            $q->where('id', $this->id);
                        })->first();
    }

	public function getCurrencyAttribute()
	{
		$cur = $this->attributes['currency'];

		if ($cur !== null) {
			return $cur;
		}

		if ($this->lang === 'da') {
			return 'DKK';
		}

		return 'USD';
	}

	public function getEnvData()
	{
        return [
            'id'         => $this->id,
            'first_name' => $this->first_name,
            'last_name'  => $this->last_name,
            'email'      => $this->email,
            'lang'       => $this->lang,
            'currency'   => $this->currency,
			'social'	 => $this->password === null ? true : false,
        ];
	}

    /*
     -------------------------------
     Helpers
     -------------------------------
     */
     
    public function requiresSetup()
    {
        if ($this->companies->isEmpty()) {
            return true;
        }
        return false;
    }

	public function touchLogin()
	{
		if ($this->last_login === null) {
			session(['first_visit' => true]);
		}
		$this->last_login = $this->freshTimestamp();
		$this->save();
	}
    
    public function hasDomain($domain)
    {
        if ($domain instanceof Domain) {
            $domain = $domain->id;
        }

        return $this->companies()
                    ->hasDomain($domain)
                    ->get()
                    ->isNotEmpty();
    }
    
    public function hasCompany($company)
    {
        if ($company instanceof Company) {
            $company = $company->id;
        }
        
        return $this->companies->contains($company);
    }
    
    public function sendPasswordResetNotification($token)
    {
        Mail::to($this)->send(new ResetPasswordMail($this, $token));
    }    
}
