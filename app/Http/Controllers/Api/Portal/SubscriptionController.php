<?php

namespace App\Http\Controllers\Api\Portal;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

use App\Models\Subscription;
use App\Models\SubscriptionTemplate;

class SubscriptionController extends Controller
{
    public function create(Request $req) {
        $data = $req->all();
        $user = Auth::user();

        if (!$user)
            return abort(404);

        $subscriptionTemplates = SubscriptionTemplate::where('slug', $data['product'])->get();

        if (!$user->companies || !count($user->companies))
            return abort(404);

        if (!$subscriptionTemplates || !count($subscriptionTemplates))
            return abort(404);

        $companyId = $user->companies[0]->id;
        $subscriptionTemplate = SubscriptionTemplate::where('slug', $data['product'])->first();

        return Subscription::create([
            'company_id' => $companyId,
            'subscription_template_id' => $subscriptionTemplate->id,
            'billing_period' => 1, // There is only monthly subscription
            'subscription_id' => $data['subscriptionId']
        ]);
    }

    public function update(Request $req)
    {
        $data = $req->all();

        $curl = curl_init('https://api.fastspring.com/subscriptions');
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($curl, CURLOPT_USERPWD, config('services.fast_spring.username') . ":" . config('services.fast_spring.password'));
        curl_setopt($curl, CURLOPT_TIMEOUT, 30);
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        $result = curl_exec($curl);
        curl_close($curl);

        return $result;
    }

    public function cancel(Request $req) {

        $data = $req->all();

        $curl = curl_init('https://api.fastspring.com/subscriptions/' . $data['subscription'] . '?billingPeriod=0');
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($curl, CURLOPT_USERPWD, config('services.fast_spring.username') . ":" . config('services.fast_spring.password'));
        curl_setopt($curl, CURLOPT_TIMEOUT, 30);
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        $result = curl_exec($curl);
        curl_close($curl);

        return $result;

    }
}
