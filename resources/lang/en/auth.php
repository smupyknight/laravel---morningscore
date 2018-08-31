<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used during authentication for various
    | messages that we need to display to the user. You are free to modify
    | these language lines according to your application's requirements.
    |
    */

    'failed' => 'These credentials do not match our records.',
    'throttle' => 'Too many login attempts. Please try again in :seconds seconds.',
	'copyright'	=> 'All Rights Reserved. Morningscore ApS.',
	'privacy_policy'	=> 'Privacy policy',
	'or'	=> 'Or',

    'pages' =>  [
        
        'login' =>  [
            'title'         => 'Login',
            'subtitle'      => 'Need a morningscore account?',
            'linktext'      => 'Register here',
            'linktext2'		=> 'if you don\'t have an account',
			'link_title'	=> 'Register an account now',
			'forgot'		=> 'forgot pass?',
			'forgot_title'	=> 'Forgot your password?',
        ],
        
        'register' =>  [
            'title'         => 'Register Account',
            'subtitle'      => 'Already have an account?',
            'linktext'      => 'Login here',
            'linktext2'		=> 'if you already have an account',
			'link_title'	=> 'Login with existing account',
			'terms'			=> 'By creating an account, you agree to the',
			'terms_link'	=> 'Terms of Service',
        ],
    ],

	'forms'	=> [
		'email'			=> 'email',
		'email_ph'		=> 'Enter your email...',
		'pass'			=> 'password',
		'pass_ph'		=> 'Enter your password...',
		'conf_pass'		=> 'confirm password',
		'conf_pass_ph'	=> 'Confirm your password...',

		'create'	=> 'create account',
		'login'		=> 'login',

		'social_reg'	=> 'register with',
		'social_login'	=> 'login with',
	],
];
