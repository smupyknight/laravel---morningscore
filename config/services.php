<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],
    
    'morningscore' => [
        'base_url' => 'https://api.msio.pw/',
    ],
    
    'google' => [
        'client_id' => '387119572306-mp5ue35gl37qbojv24pnolukj3akek1v.apps.googleusercontent.com',
        'client_secret' => 'vSNaL9T501jfwhqvpiSO3CyK',
        'redirect' => 'https://app.morningscore.io/social/google/callback',

        // Old test account
        // 'client_id' => '127507306186-117eu5gtvdiq6dnfbmli3v66k81ki4g7.apps.googleusercontent.com',
        // 'client_secret' => 'RuTbivt7e39Ix8hK2ggudiZ_',
        // 'redirect' => 'http://localhost/morningscore/public/social/google/callback',
    ],
    
    'facebook' => [
        'client_id' => '541035066272759',
        'client_secret' => 'c40b533fc464be45a80d524ca91eed30',
        'redirect' => 'https://app.morningscore.io/social/facebook/callback',
        
        // Old test account
        // 'client_id' => '1917224005196966',
        // 'client_secret' => '87bb71588797c4627afe25256838e245',
        // 'redirect' => 'http://localhost/morningscore/public/social/facebook/callback',
    ],
    
    'viral_loops' => [
        
        'current' => [
            'campaign_id'   => 'S22385hVISZDHrqc4Gp77qD0tH8',
            'api_token'     => 'c3RC3YsWtYYxXoVargflIhNo3IQ',
        ],
    ],

    'fast_spring' => [
        'username'  => 'HVQRVSMQSRC61H9DE7NREG',
        'password'  => 'ovLNX8csQRKHX6tZRNmlAA'
    ]

];
