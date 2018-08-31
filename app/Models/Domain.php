<?php

namespace App\Models;

use App\Traits\HasConnectionParameters;
use Morningscore;

class Domain extends BaseDomain
{
    use HasConnectionParameters;

    public function newQuery()
    {
        return parent::newQuery()->whereNull('competitor_for');
    }

    /* 
     ------------------------------- 
     Relationships 
     ------------------------------- 
     */ 
     
    public function competitors()
    {
        return $this->hasMany(Competitor::class, 'competitor_for')->limit(3);
    }
    
	public function activeKeywords()
	{
        return $this->hasMany(DomainKeyword::class)->active();
	}

    /* 
     ------------------------------- 
     Scopes 
     ------------------------------- 
     */ 
     
	public function scopeHasCompany($q, $company)
	{
		if ($company instanceof Company) {
			$company = $company->id;
		}

		return $q->whereHas('companies', function ($q) use ($company) {
			$q->where('id', $company);
		});
	}

	public function scopeWhereHasLocale($q, $locale)
	{
		if ($locale instanceof Locale) {
			$locale = $locale->id;
		}

		return $q->whereHas('locales', function ($q) use ($locale) {
			$q->where('id', $locale);
		});
	}

    /* 
     ------------------------------- 
     Accessors 
     ------------------------------- 
     */ 

	public function getDefaultLocaleAttribute()
	{
		// TODO: BETA HARDCODE
		// return Locale::getDefault();

		return $this->locales()->first();
	}
     
	public function getEnvDataAttribute()
	{
        return [
            'domain'           => $this->domain,
            'id'               => $this->id,
            'tracked_keywords' => $this->activeKeywords()->pluck('keyword'),
            'competitors'      => [
                'domains' => $this->competitors->pluck('domain'),
                'colors'  => $this->competitors->pluck('color', 'domain_safe'),
            ],
            'locale_id'        => $this->default_locale->id,
            'gl'               => strtolower($this->default_locale->gl),
            'hl'               => $this->default_locale->hl,
        ];
	}
     
    /* 
     ------------------------------- 
     Helpers
     ------------------------------- 
     */ 

	public function sync()
	{
		$hostname = Morningscore::submitDomain($this, $this->default_locale);
        if ($hostname === null) {
            return; // error
        }

		$this->update([
			'domain'    => $hostname,
			'is_synced' => true,
		]);
	}

	public function hasLocale($locale)
	{
		if ($locale instanceof Locale) {
			$locale = $locale->id;
		}

		return $this->locales()
					->where('id', $locale)
					->get()
					->isNotEmpty();
	}

    public function updateCompetitors(array $domains)
    {
        if(empty($domains)){
			Competitor::where('competitor_for', $this->id)->delete();
			return;
		}
		// Delete selected
		Competitor::where('competitor_for', $this->id)
					->whereNotIn('domain', $domains)
					->delete();
		
		// Create
		$this->addCompetitors($domains);
    }
    
    public function addCompetitors(array $domains)
    {
        $existing = Competitor::where('competitor_for', $this->id)
                                ->whereIn('domain', $domains)
                                ->get()
                                ->keyBy('domain');
        
        foreach($domains as $domain){
            $competitor = $existing->get($domain);
            
            if($competitor === null){

                $competitor = new Competitor();
                $competitor->competitor_for = $this->id;
                $competitor->domain         = $domain;

            }

            $hostname = Morningscore::submitDomain($competitor, $this->default_locale);
            if ($hostname !== null && $hostname === $domain) {
                $competitor->is_synced = true;
            }

            if($competitor->isDirty()){
                $competitor->save();
            }
        }
    }

	public function filterKeywords(array $keywords)
	{
		// existing kws
		$db_kws = $this->activeKeywords()->pluck('keyword')->toArray();

		// ignore existing keywords
		return array_diff($keywords, $db_kws);
	}

	public function addKeywords($keywords)
	{
		$locale = $this->default_locale; // default locale

		$kws = array_map(function($kw) use ($locale) {
			return [
				'keyword' => $kw,
				'locale_id' => $locale->id,
			];
		}, $keywords);

		if (empty($kws)) {
			\Log::error('no keywords left to create');
			return;
		}

		// create in db
		$created = $this->keywords()->createMany($kws);

		$this->trackKeywords($created);
	}

	public function trackKeywords($keywords)
	{
		$locale = $this->default_locale; // default locale

		// track in MS
		$tracked = Morningscore::trackKeywords(
			strtolower($locale->gl),
			$locale->hl,
			$this->domain,
			$keywords->pluck('keyword')->toArray()
		);

		if ($tracked === null) {
			\Log::error('keywords didnt track');
			return;
		}

		// updt successfully tracked kws
		$to_updt = $keywords->reject(function ($value) use ($tracked) {
			return ! in_array($value->keyword, $tracked);
		})->pluck('id')->toArray();

		DomainKeyword::whereIn('id', $to_updt)->update(['is_synced' => true]);
	}

	public function delete()
	{
		Competitor::where('competitor_for', $this->id)->delete(); // this will not fire delete events on Competitor model
		$this->locales()->detach();
		$this->keywords()->delete();
		$this->companies()->detach();
		parent::delete();
	}
}
