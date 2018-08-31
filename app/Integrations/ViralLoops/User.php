<?php

namespace App\Integrations\ViralLoops;

trait User
{
    //====================================================================== 
    // GETTERS 
    //====================================================================== 
    
    public function userData(string $email, array $accessors = [])
    {
        $query = [
            'params' => [
                'user' => [
                    'email' => $email,
                ],
                'accessors' => $accessors,
            ],
        ];
        
        return $this->client->GET('data', $query)->getBody();
    }
    
    public function allUserData(string $email)
    {
        $accessors = [
            'userData',
            'referralCount',
            'referrerInfo',
            'referrals',
            'referralCounters',
            'shareCounters',
        ];
        
        return $this->userData($email, $accessors);
    }
    
    //====================================================================== 
    // ACTIONS 
    //====================================================================== 
    
    public function registerUser(string $email, string $code = "", string $source = "", string $fname = "", string $lname = "")
    {
        $query = [
            'params' => [
                'event' => 'registration',
                'user'  => [
                    'firstname' => $fname,
                    'lastname'  => $lname,
                    'email'     => $email,
                ],
                'referrer'  => [
                    'referralCode' => $code,
                ],
                'refSource' => $source,
            ],
        ];
        
        return $this->client->POST('events', $query)->getBody();
    }

    /* 
    *  if type === email: sends out invite mails
    *  else only used for tracking analytics
    *  valid types: facebook, twitter, reddit, email
    */ 
    public function inviteEvent(string $code, string $type, array $data = [])
    {
        $url = 'https://app.viral-loops.com/api/v1/social_action';
        $querry = [
            'referralCode'  => $code,
            'postType'      => $type,
            'postData'      => $data,
        ];
        
        return $this->client->POST($url, $querry)->getBody();
    }
    
    // Altruistic Referral
    public function conversionEvent(string $email)
    {
        $query = [
            'params' => [
                'event' => 'conversion',
                'user'  => [
                    'email' => $email,
                ],
            ],
        ];
        
        return $this->client->POST('events', $query)->getBody();
    }
    
    public function orderEvent(string $userCode, float $amount)
    {
        $query = [
            'params' => [
                'event' => 'order',
                'user'  => [
                    'referralCode' => $userCode,
                ],
                'amount' => $amount,
            ],
        ];
        
        return $this->client->POST('events', $query)->getBody();
    }

}
