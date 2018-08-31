<?php

use Faker\Generator as Faker;

/* @var Illuminate\Database\Eloquent\Factory $factory */

$factory->define(App\Models\SubscriptionModifier::class, function (Faker $faker) {
    $rand = mt_rand(0,1);
    return [
        'modifiable_id'    => function () use ($rand) {
            if ($rand) {
                return App\Models\Subscription::inRandomOrder()->first()->id;
            }
            return App\Models\Company::inRandomOrder()->first()->id;
        },
        'modifiable_type'    => function () use ($rand) {
            if ($rand) {
                return 'App\Models\Subscription';
            }
            return 'App\Models\Company';
        },

        'amount'        => $faker->randomDigitNotNull,
        'modifier_type' => $faker->numberBetween(1, 3),
    ];
});
