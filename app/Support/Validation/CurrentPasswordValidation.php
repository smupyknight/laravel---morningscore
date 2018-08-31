<?php

namespace App\Support\Validation;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CurrentPasswordValidation implements Rule
{
    public function passes($attribute, $value)
    {
        $current_pass = request()->get('current_password');
        if (is_string($current_pass) && strlen($current_pass) > 5) {
            \Log::info(Auth::user()->password);
            \Log::info(Hash::check($current_pass, Auth::user()->password));
            return Hash::check($current_pass, Auth::user()->password);
        }
        return false;
    }

    public function message()
    {
        return "Invalid password";
    }

}