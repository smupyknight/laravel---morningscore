<?php

namespace App\Services;

use App\Models\Domain;

class Google
{

	public function client($domain = null){
		$client = new \Google_Client();
		$client->setAuthConfig([
			'client_id' => config('services.google.client_id'),
			'client_secret' => config('services.google.client_secret')
		]);
		$client->setAccessType ("offline");
		$client->setApprovalPrompt ("force");
		$client->addScope(\Google_Service_Analytics::ANALYTICS_READONLY);
		$client->addScope(\Google_Service_Webmasters::WEBMASTERS_READONLY);
		$client->setRedirectUri(config('services.google.redirect'));
		if(!is_null($domain) && $domain->company->isConnectedToGoogle()){
			$client->setAccessToken($domain->company->googleConnection->getParameter('access_token'));
			$client->refreshToken($domain->company->googleConnection->getParameter('refresh_token'));
			$access_token = $client->getAccessToken();
			foreach($domain->company->googleConnection->connectionParameters as $parameter){
				switch($parameter->parameter_key){
					case 'access_token':
						$parameter->parameter_value = $access_token['access_token'];
						break;
					case 'refresh_token':
						$parameter->parameter_value = $access_token['refresh_token'];
						break;
				}
				$parameter->save();
			}
		}
		return $client;
	}

	public function analytics(Domain $domain){
		if(!$domain->company->isConnectedToGoogle()){
			return null;
		}
		$client = $this->client($domain);
		$analytics = new \Google_Service_Analytics($client);
		return $analytics;
	}

	public function getAccessToken(Domain $domain){
		return $this->client($domain)->getAccessToken();
	}

	public function webmasters(Domain $domain){
		if(!$domain->company->isConnectedToGoogle()){
			return null;
		}
		$client = $this->client($domain);
		$webmasters = new \Google_Service_Webmasters($client);
		return $webmasters;
	}

}