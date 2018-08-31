<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Cache;

class Locale extends Model
{
	public $timestamps = false;

	protected $casts = [
		'is_primary'	=> 'boolean',
	];

    protected $fillable = [
        'gl',
        'hl',
        'country',
        'language',
        'search_engine',
		'is_primary',
    ];

    // Relations
    public function domains()
    {
        return $this->belongsToMany(Domain::class);
    }
    
    public function keywords()
    {
        return $this->hasMany(DomainKeyword::class);
    }
    
    // Attributes
    public function getHlGlAttribute()
    {
        return "{$this->hl}_{$this->gl}";
    }

	public function getIsPrimaryAttribute()
	{
		if ($this->attributes['is_primary']) {
			return true;
		}

		if (self::where('country', $this->country)->count() < 2) {
			return true;
		}

		return $this->attributes['is_primary'];
	}

	public function getDisplayAttribute()
	{
		return "{$this->country} | {$this->language}";
	}

	public function getIconAttribute()
	{
		$code = strtolower($this->gl);

		// Special Cases
		// DRCongo and RCongo
		if (strtolower($code) === "cd" &&
			substr($this->search_engine, -1) === "g"
		) {
			$code = 'cg';
		}
		// Faroe Islands 
		if (strtolower($code) === "dk" &&
			$this->hl === 'fo'
		) {
			$code = 'fo';
		}

		return $code;
	}

	public function getEnvDataAttribute()
	{
		return [
			'id'			=> $this->id,
			'display'		=> $this->display,
			'icon_name'		=> $this->icon,
			'is_primary'	=> $this->is_primary,
		];
	}

	// Statics
	public static function getEnvData()
	{
		return Cache::remember('locales', 10080, function() {

			$all = self::all();

			return $all
				->groupBy('country')
				->map(function ($locales, $country) {
					$country = [];
					foreach ($locales as $locale) {
						if ($locale->is_primary) {
							$country[$locale->language] = $locale->env_data;
						}
					}
					return $country;
				})->all();
		});
	}

	public static function getDefault()
	{
		// TODO: BETA HARDCODE
		return self::where('hl', 'da')->where('gl', 'DK')->first();
	}
}
