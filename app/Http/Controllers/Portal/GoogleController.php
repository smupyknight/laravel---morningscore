<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use App\Models\Connection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Support\Enums\SocialiteServiceType;
use Google;

class GoogleController extends Controller
{
    protected $service = 0;
    
    public function __constructer()
    {
        $google = SocialiteServiceType::slugToType('google');
        if ($google !== null) {
            $this->service = $google;
        }
    }
    
    public function connectWithOauth(Request $request, $domain_id = 0)
    {
        if ($domain_id === 0 && session()->has('domain_to_connect')) {
            $domain_id = session()->get('domain_to_connect');
        }

        $company = Auth::user()->companies()->hasDomain($domain_id)->first();
        $domain = $company->domains()->where('id', $domain_id)->first();
        
        if (is_null($domain)) {
            //Something went very wrong
            return;
        }

        if (! $company->isConnectedToGoogle()) {
            session()->put('domain_to_connect', $domain->id);
            return redirect()->route('portal.social', 'google');
        }
        
        if (! $domain->hasGoogleAnalyticsView()) {
            return $this->getDomainView($request, $company, $domain);
        }

        return redirect()->route('portal.home');
    }
    
    public function connectCompany($data)
    {
        $domain_id  = session()->get('domain_to_connect');
        $company = Auth::user()->companies()->hasDomain($domain_id)->first();
        
        $connection = $company->googleConnection;
        
        if (is_null($connection)) {
            $connection             = new Connection();
            $connection->service    = $this->service;
            $connection->company_id = $company->id;
            $connection->save();
        }
        
        $connection->setParameter('access_token', $data->token);
        $connection->setParameter('refresh_token', $data->refreshToken);
    }
    
    public function getDomainView(Request $request, $company, $domain)
    {
        $analytics = Google::analytics($domain);
        
        try {
            $accounts = $analytics->management_accounts->listManagementAccounts();
            
        } catch (\Google_Service_Exception $e) {
            $error = json_decode($e->getMessage());
            return redirect()
                ->route('portal.home')
                ->withErrors($error->error->message);
        }
        
        $items    = collect($accounts->getItems())->pluck('name', 'id');
        
        $items = $items->sort(function ($a, $b) {
            return strcmp(strtolower($a), strtolower($b));
        });
        
        view()->share('domain', $domain->domain);

        if ( ! $request->has('analytics_account')) {
            return view('portal.templates.domain')->with('accounts', $items)->render();
        }

        $properties = $analytics->management_webproperties->listManagementWebproperties($request->get('analytics_account'));
        if (count($properties->getItems()) > 0) {
            $properties = collect($properties->getItems())->pluck('name', 'id');
            
            if ( ! $request->has('analytics_property')) {
                return view('portal.templates.domain')->with('accounts', $items)->with('properties', $properties)->render();
            }
            
            $profiles = $analytics->management_profiles->listManagementProfiles($request->get('analytics_account'), $request->get('analytics_property'));
            
            $views = collect($profiles->getItems())->pluck('name', 'id');;
            
            if ( ! $request->has('analytics_view')) {
                return view('portal.templates.domain')->with('accounts', $items)->with('properties', $properties)->with('views', $views)->render();
            }
            
            $viewId = $request->get('analytics_view');
            
            $company->googleConnection->setParameter('view_id', $viewId, $domain->id);
            
        }
        return redirect()->route('portal.home');
    }

}
