<?php

namespace App\Http\Controllers\Portal;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Support\Enums\SocialiteServiceType;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Controller;

class AccountsController extends Controller
{
    public function socialCallback($userData, $service)
    {
        $user = Auth::user();
        $service_type = SocialiteServiceType::slugToType($service);
        
        // check if domain is set
        if ($service === 'google' && session()->has('domain_to_connect')) {
            $link = new GoogleController;
            $link->connectCompany($userData);
            return redirect()->route('portal.google.connect');
        }
        
        // check if user is linked
        $userToken = $user->userTokens()->hasServiceId($service_type, $userData->id)->first();
        
        // if not linked -> link
        if ($userToken === null) {
            $link = new RegisterController;
            $link->createUserToken($user, $service_type, $userData);
            return redirect()->route('portal.home');
            
        // if linked -> update?
        } else {
            
        }
    }
}
