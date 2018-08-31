<?php

use Faker\Generator as Faker;

/* @var Illuminate\Database\Eloquent\Factory $factory */

$factory->define(App\Models\Company::class, function (Faker $faker) {
    return [
        'name'      => 'Morning Train Technologies ApS',
        'website'   => 'morningtrain.dk',
        'phone'     => '+4569692642',
        'country'   => 'Denmark',
        'city'      => 'Odense',
        'zipcode'   => '5000',
        'address'   => 'Gammelsø 4 1.TH',
    ];
});
