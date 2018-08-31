<?php

namespace App\Integrations\ViralLoops;

trait Reward
{
    //====================================================================== 
    // GETTERS 
    //====================================================================== 
    
    public function pendingRewards(string $email = '', int $limit = 25, int $skip = 0) // max limit is 25
    {
        $query = [
            'filter' => [
                'limit' => $limit,
                'skip'  => $skip,
            ],
        ];
        
        if ($email !== '') {
            $query['user'] = [
                'email' => $email,
            ];
        }

        return $this->client->GET('pending_rewards', $query)->getBody();
    }
    
    public function redeemedRewards(string $email = '', int $limit = 25, int $skip = 0)
    {
        $query = [
            'filter' => [
                'limit' => $limit,
                'skip'  => $skip,
            ],
        ];
        
        if ($email !== '') {
            $query['user'] = [
                'email' => $email,
            ];
        }

        return $this->client->GET('given_rewards', $query)->getBody();
    }

    //====================================================================== 
    // ACTIONS 
    //====================================================================== 
    
    public function redeemReward(string $rewardId)
    {
        $query = [
            'rewardId' => $rewardId,
        ];
        
        return $this->client->POST('rewarded', $query)->getBody();
    }
    
    public function redeemUserRewards(string $email)
    {
        $query = [
            'user' => [
                'email' => $email,
            ],
        ];
        
        return $this->client->POST('rewarded', $query)->getBody();
    }
}
