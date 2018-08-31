<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Auth\LoginController;
use App\Support\Enums\SocialiteServiceType;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Socialite;

class SocialiteController extends Controller
{
    public function redirectToProvider($service)
    {
        if (SocialiteServiceType::slugToType($service) !== null) {
            $socialite = Socialite::driver($service);
            if ($service === 'facebook') {
                $socialite = $socialite->asPopup();
            }
            
            if ($service === 'google' && Auth::check()) { // Incremental authorization
                $socialite = $socialite->scopes(['https://www.googleapis.com/auth/analytics.readonly']);
            }
            
            return $socialite->with([
                                    "access_type" => "offline",
                                    "prompt" => "consent select_account"
                                ])->redirect();
        }
        $err = ['message' => 'Service not supported'];
        return redirect()
            ->back()
            ->withErrors($err);
    }
    
    public function handleProviderCallback($service)
    {
        if (SocialiteServiceType::slugToType($service) === null) {
            $err = ['message' => 'Service not supported'];
            return redirect()
                ->back()
                ->withErrors($err);
        }
        try {
            $data = Socialite::driver($service)->user();
            
        } catch (\Exception $e) {
            $err = ['message' => 'Could not validate user'];
            return redirect()
                ->route('portal.home') // TODO - not optimal: doesn't show error for not logged in user
                ->withErrors($err);
        }
        // validate user information
        $userData = Socialite::driver($service)->userFromToken($data->token);
        // TODO - do this better
        $userData->refreshToken = $data->refreshToken;
        $userData->expiresIn = $data->expiresIn;
        
        if (Auth::check()) {
            $callback = new AccountsController; // link accounts & edit permissions
        } else {
            $callback = new LoginController; // login & register
        }

        return $callback->socialCallback($userData, $service);
    }
}
