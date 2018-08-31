<?php

namespace App\Http\Controllers\Api\Webhooks;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Artisan;

class ViralLoopsController extends Controller
{
    public function register(Request $req)
    {
        $data = json_decode($req->getContent());
        
        if ($data->type !== 'participation')
        {
            return response('', 400);
        }
        
        Artisan::call('viral-loops:fetch-users', [
            'email' => $data->user->email,
        ]);
        \Log::info(Artisan::output());

    }
    
    public function milestone(Request $req)
    {
        $data = json_decode($req->getContent());
        
        if ($data->type !== 'milestoneReached')
        {
            return response('', 400);
        }
        Artisan::call('viral-loops:fetch-rewards', [
            'email' => $data->referrer->email,
        ]);
        \Log::info(Artisan::output());

    }
}