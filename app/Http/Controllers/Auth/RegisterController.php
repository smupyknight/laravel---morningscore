<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\UserToken;
use App\Models\Company;
use App\Models\Domain;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use MorningTrain\Foundation\Context\Context;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }
    
    public function redirectTo()
    {
        $user = Auth::user();
        
        if ($user->isSuper()) {
            return route('admin');
        }
        
        if ($user->isAssigned('customer')) {
            return route('portal.home');
        }
        
        return route('auth.logout');
    }
    
    public function showRegisterForm()
    {
        return Context::render('templates.register');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
        $user->assign(['customer']);
        
		$user->touchLogin();
        return $user;
    }

    public function registerFromService($service, $data)
    {
        $validator = Validator::make(['email' => $data->email], [
            'email' => 'required|string|email|max:255|unique:users',
        ]);

        if ($validator->fails()) {
            return redirect()
                        ->route('auth.login')
                        ->withErrors($validator);
        }
        
        $names = explode(' ', $data->name);
        
        $user = User::create([
            'last_name'     => array_pop($names),
            'first_name'    => join(' ', $names),
            'nickname'      => $data->nickname,
            'email'         => $data->email,
            'avatar'        => $data->avatar,
        ]);
        $user->assign(['customer']);
        
        return $this->createUserToken($user, $service, $data, true);
    }
    
    public function createUserToken(User $user, $service, $data, $primary = false)
    {
        $args = [
            'user_id'       => $user->id,
            'service'       => $service,
            'is_primary'    => $primary,
        ];

        if (isset($data->id)) {
            $args['service_user_id'] = $data->id;
        }
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
        
        $userToken = UserToken::create($args);
        
        return $userToken;
    }
}
