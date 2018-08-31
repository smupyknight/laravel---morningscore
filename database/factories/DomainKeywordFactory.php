<?php

use Faker\Generator as Faker;

/* @var Illuminate\Database\Eloquent\Factory $factory */

$factory->define(App\Models\DomainKeyword::class, function (Faker $faker) {
    $domain = App\Models\Domain::inRandomOrder()->first();
    return [
        'domain_id' => $domain->id,
        'locale_id' => $domain->locales()->inRandomOrder()->first()->id,
        'keyword'   => $faker->word,
    ];
});
