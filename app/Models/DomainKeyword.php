<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DomainKeyword extends Model
{
    protected $fillable = [
        'domain_id',
        'locale_id',
        'keyword',
        'is_synced',
        'active',
    ];
    
    protected $casts = [
            'active' => 'boolean',
            'is_synced' => 'boolean',
    ];

    /* 
     ------------------------------- 
     Relations 
     ------------------------------- 
     */ 
    public function domain()
    {
        return $this->belongsTo(Domain::class);
    }
    
    public function locale()
    {
        return $this->belongsTo(Locale::class);
    }
    
    /* 
     ------------------------------- 
     Scopes 
     ------------------------------- 
     */ 
	public function scopeActive($q)
	{
		return $q->where('active', true);
	}

	public function scopeSynced($q)
	{
		return $q->where('is_synced', true);
	}

	public function scopeNotSynced($q)
	{
		return $q->where('is_synced', false);
	}

	public function scopeHasCompany($q, $company)
	{
		if ($company instanceof Company) {
			$company = $company->id;
		}

		return $q->whereHas('domain.companies', function($q) use ($company) {
			$q->where('id', $company);
		});
	}

    /* 
     ------------------------------- 
     Helpers 
     ------------------------------- 
     */ 
     
    // check if there are active keywords, just like this one
    public function activeLikeThis()
    {
        return DomainKeyword::where('keyword', $this->keyword)
                                ->where('active', true)
                                ->exists();
    }

    /* 
     ------------------------------- 
     Static Helpers
     ------------------------------- 
     */ 

	public static function processInput(string $keywords)
	{
		if ( ! is_string($keywords)) {
			return null;
		}

		// handle kws
		$keywords = preg_split("/\r\n|\n|\r|,/", mb_strtolower($keywords));

		if (! is_array($keywords)) {
			\Log::error('keywords is not an array');
			return null;
		}

		// further handle kws
		$keywords = array_unique(array_filter(array_map('trim', $keywords)));

		return $keywords;
	}
}
