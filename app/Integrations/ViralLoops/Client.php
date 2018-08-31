<?php

namespace App\Integrations\ViralLoops;

use GuzzleHttp\Client as Guzzle;

class Client
{
    protected $api_token;
    protected $client;

    public function __construct(string $campaignName)
    {
        $this->api_token = config("services.viral_loops.$campaignName.api_token");
        
        $this->client = new Guzzle([
            'base_uri'  => 'https://app.viral-loops.com/api/v2/',
            'headers'   => [
                'Content-Type' => 'application/json',
            ],
        ]);
    }
    
    public function GET(string $endpoint, array $query = [])
    {
        $query['apiToken'] = $this->api_token;

        try {
            $response = $this->client->request('GET', $endpoint, ['query' => $query]);
            return $response;
        } catch (ClientException $e) {
    
        }
    }
    
    public function POST(string $endpoint, array $query = [])
    {
        $query['apiToken'] = $this->api_token;        
        
        try {
            $response = $this->client->request('POST', $endpoint, ['query' => $query]);
            return $response;
        } catch (ClientException $e) {
            
        }
    }
}
