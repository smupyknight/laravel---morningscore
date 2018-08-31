<?php

use Faker\Generator as Faker;

/* @var Illuminate\Database\Eloquent\Factory $factory */

$factory->define(App\Models\Domain::class, function (Faker $faker) {
    return [
        'domain'    => 'morningtrain.dk',
    ];
});
