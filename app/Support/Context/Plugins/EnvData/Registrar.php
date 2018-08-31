<?php

namespace App\Support\Context\Plugins\EnvData;

use App\Models\Domain;
use App\Models\Company;
use App\Models\User;
use App\Models\Locale;
use Illuminate\Support\Facades\Auth;
use MorningTrain\Foundation\Context\Context;
use Carbon\Carbon;

class Registrar
{
    protected $domain;
    
    public function export()
    {
        Context::localization()->provide('env', function () {
            
            $domain = $this->getDomain();
            $user   = Auth::user();
            
            if ($domain !== null) {
                $comp = Company::hasUserAndDomain($user->id, $domain->id)->first();
            } else {
                $comp = null;
            }
            
            $from = Carbon::now('UTC')->startOfDay()->subDays(30)->toIso8601String();
            $to   = Carbon::now('UTC')->startOfDay()->toIso8601String();
            
            return [
                'domain'       => ($domain !== null) ? $domain->env_data : null,
                'user'         => $user->getEnvData(),
                'company'      => ($comp !== null) ? $comp->getEnvData() : null,
                'domains'      => ($comp !== null) ? $comp->getEnvDataDomains() : null,
                'translations' => $this->getTranslations($user),
				'locales'      => Locale::getEnvData(),
				'debug'        => \App::environment('production') ? false : true,
                
                // Basic defaults
                'period'       => [
                    'from' => $from,
                    'to'   => $to,
                ],
            ];
        });
    }
    
    
    /* 
     ------------------------------- 
     Domain 
     ------------------------------- 
     */
    
    public function domain($domain_id = null)
    {
        return count(func_get_args()) === 0 ? $this->getDomain() : $this->setDomain($domain_id);
    }
    
    protected function setDomain($domain_id = null)
    {
        $user = Auth::user();
        
        // serve requested domain - default behavior
        if ($domain_id !== null && $user->hasDomain($domain_id)) {
            $this->domain = Domain::where('id', $domain_id)->first();
            
            return;
        }
        
        // serve default user domain - fallback
        $this->domain = $user->fallback_domain;
        
        // something has gone quite wrong - user should have a domain
        if ($this->domain === null) {
            //throw new \Exception("User doesn't have a domain");
        }
    }
    
    protected function getDomain()
    {
        if ( ! isset($this->domain) || is_null($this->domain)) {
            $this->setDomain();
        }
        
        return $this->domain;
    }
    
    /* 
     ------------------------------- 
     Other 
     ------------------------------- 
     */
    
    protected function getTranslations(User $user)
    {
        return [
            'report' => trans('report'),
        ];
    }
    
}
