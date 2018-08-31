<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use MorningTrain\Foundation\Context\Context;
use Illuminate\Support\Facades\Auth;
use App\Support\Enums\SocialiteServiceType;
use App\Models\UserToken;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        return Context::render('templates.login');
    }
    
    protected function authenticated($request = null, $user = null)
    {
        $user = Auth::user();
		$user->touchLogin();
        
        if ($user->isSuper()) {
            return redirect()->route('admin');
        }
        
        if ($user->isAssigned('customer')) {
            if ($user->requiresSetup()) {
                return redirect()->route('portal.setup');
            }
            return redirect()->route('portal.home');
        }
        
        return redirect()->route('auth.logout');
    }
    
    
    public function socialCallback($userData, $service)
    {
        // check if user exists
        $service_type = SocialiteServiceType::slugToType($service);
        $userToken = UserToken::has('user')
                                ->hasServiceId($service_type, $userData->id)
                                ->primary()
                                ->with('user')
                                ->first();
        
        // register if not
        if ($userToken === null || $userToken->user === null) {
            $register = new RegisterController;
            $userToken = $register->registerFromService($service_type, $userData);
            if ( ! ($userToken instanceof UserToken)) {
                return $userToken;
            }
        
        } else {
            // update user token
            $this->updateUserToken($userToken, $userData);
        }
        
        Auth::login($userToken->user);
        return $this->authenticated();
    }
    
    public function updateUserToken(UserToken $userToken, $data)
    {
        $args = [];
        
        if (isset($data->token)) {
            $args['token'] = $data->token;
        }
        if (isset($data->tokenSecret)) {
            $args['token_secret'] = $data->tokenSecret;
        }
        if (isset($data->refreshToken)) {
            $args['refresh_token'] = $data->refreshToken;
        }
        if (isset($data->expiresIn)) {
            $args['expiration'] = $data->expiresIn;
        }
        
        $userToken->update($args);
    }
}
