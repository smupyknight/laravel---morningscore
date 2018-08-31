<?php

namespace App\Http\Controllers\Api\Webhooks;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Subscription;
use App\Models\SubscriptionTemplate;

class FastSpringController extends Controller
{
    public function subscription(Request $req)
    {
        $data = $req->all();
        $event = $data['events'][0];

        if ($event['type'] == 'subscription.updated') {
            $product = $event['data']['product'];
            $subscriptionId = $event['data']['subscription'];

            $subscription = Subscription::where('subscription_id', $subscriptionId)->first();
            $subscriptionTemplate = SubscriptionTemplate::where('slug', $product)->first();

            if (!$subscription || !$subscriptionTemplate)
                return abort(404);

            $subscription->update([
                'subscription_template_id' => $subscriptionTemplate->id
            ]);
        } else if ($event['type'] == 'subscription.deactivated' || $event['type'] == 'subscription.charge.failed') {
            $subscriptionId = $event['data']['subscription'];

            $subscription = Subscription::where('subscription_id', $subscriptionId)->first();
            if (!$subscription)
                return abort(404);

            $subscription->delete();
        }
    }
}
