<?php

use Faker\Generator as Faker;

/* @var Illuminate\Database\Eloquent\Factory $factory */

$factory->define(App\Models\Subscription::class, function (Faker $faker) {
    return [
        'company_id' => function () {
            return factory(App\Models\Company::class)->create()->id;
        },
        'subscription_template_id'  => function () {
            return App\Models\SubscriptionTemplate::inRandomOrder()->first()->id;
        },
        'billing_period'  => function ($sub) {
            return App\Models\SubscriptionTemplate::find($sub['subscription_template_id'])->prices()->inRandomOrder()->first()->billing_period;
        },
    ];
});
