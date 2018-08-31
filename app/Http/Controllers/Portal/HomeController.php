<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use MorningTrain\Foundation\Context\Context;
// use App\Support\Util\JWT;
use Carbon\Carbon;

use App\Models\Subscription;

class HomeController extends Controller
{
    
    public function show()
    {
        $view = Context::render('pages.report');
        $user = Auth::user();
        
        // User has no companies
        if ($user->companies->first() === null || $user->requiresSetup()) {
            return redirect()->route('portal.setup');
        }
        
        view()->share('title', transOr('report.page_title', 'Report'));
        
        // // generate JWT
        // $exp_time = Carbon::now()->addHour(4)->timestamp;
        // $jwt = JWT::generate($comp->id, $exp_time);
        // 
        // // Provide React env
        // Context::localization()->provide('env', function () use ($jwt, $domain) {
        //     return [
        //         'jwt'              => $jwt,
        //     ];
        // });
        
        return $view->render();
    }

    public function payment()
    {
        $companies = Auth::user()->companies()->get();

        $subscription = null;
        if ($companies && $companies->count())
            $subscription = Subscription::where('company_id', $companies[0]->id)->first();

        $view = Context::render('pages.payment');
        view()->share('subscription', $subscription);
        return $view->render();
    }
    
}
