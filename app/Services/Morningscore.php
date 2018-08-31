<?php

namespace App\Services;

use App\Models\BaseDomain;
use App\Models\Locale;
use App\Models\DomainKeyword;
use GuzzleHttp\Client;

class Morningscore
{
    private $uri;
    private $client;
    
    public function __construct()
    {
        $this->uri = config('services.morningscore.base_url');
        
        $this->client = new Client([
            'base_uri'  => $this->uri,
            'timeout'   => 20.0,
        ]);
    }
    
    
    /* 
     ------------------------------- 
     Domains
     ------------------------------- 
     */ 
     
    public function submitDomain($domain, Locale $locale)
    {
        if ($domain instanceof BaseDomain) {
            $domain = $domain->domain;
        }
        
        $data = [
            'domain'                => $domain,
            'gl_hl'                 => $locale->hl_gl, // not a typo: gl_hl = hl_gl
            'active'                => true,
            'should_fetch_keywords' => true,
        ];
        
        $response = self::postRequest('domain/add', $data);
        return ($response === null) ? null : $response->hostname;
    }
    
    public function checkDomain($domain)
    {
        if ($domain instanceof BaseDomain) {
            $domain = $domain->domain;
        }

        $data = [
            'domain' => $domain
        ];

        $response = self::postRequest('domain/check', $data);
        return ($response === null) ? null : $response->hostname;
    }
    
    /* 
     ------------------------------- 
     Keywords 
     ------------------------------- 
     */ 
     
    public function submitKeyword(DomainKeyword $keyword, bool $track)
    {
        $data = [
            "gl"        => strtolower($keyword->locale->gl),
            "hl"        => $keyword->locale->hl,
            "keyword"   => $keyword->keyword,
            "domain"    => $keyword->domain->domain,
            "tracked"   => $track,
        ];

        $response = self::postRequest('keyword/add', $data);
        return ($response === null) ? false : true;
    }

	public function trackKeywords(string $gl, string $hl, string $domain, array $keywords)
	{
		$data = [
			'gl'		=> $gl,
			'hl'		=> $hl,
			'domain'	=> $domain,
			'keywords'	=> $keywords,
		];

		$response = self::postRequest('keywords/add', $data);
        return ($response === null) ? null : $response->tracked;
	}
    
    public function trackKeyword(DomainKeyword $keyword)
    {
        return $this->submitKeyword($keyword, true);
    }
    
    public function untrackKeyword(DomainKeyword $keyword)
    {
        return $this->submitKeyword($keyword, false);
    }
    
    /* 
     ------------------------------- 
     Request 
     ------------------------------- 
     */ 
     
    public function postRequest(string $endpoint, array $data)
    {
        try {
            $response = $this->client->request('POST', $endpoint, [
                'json' => $data,
            ]);
        } catch (\Exception $e) {
            \Log::error('Morningscore error:' . $e);
            return null;
        }
        
        
        if ($response->getStatusCode() !== 200) {
            return null;
        }
        
        if ($response->getStatusCode() === 503) { // TODO - notify
            \Log::error('Morningscore returned 503');
            \Log::error($response->getBody());
            return null;
        }
        
        \Log::info($response->getBody());
        $response = json_decode($response->getBody());
        if (isset($response->failed) && $response->failed === true) {
            return null;
        }
        if (isset($response->failure) && $response->failure === true) {
            return null;
        }

        return $response;
    }
}
