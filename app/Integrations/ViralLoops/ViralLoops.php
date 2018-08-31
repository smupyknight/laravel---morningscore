<?php

namespace App\Integrations\ViralLoops;

class ViralLoops
{
    use User;
    use Reward;
    
    protected $client;

    public function __construct(string $campaignName)
    {
        $this->client   = new Client($campaignName);
    }

}