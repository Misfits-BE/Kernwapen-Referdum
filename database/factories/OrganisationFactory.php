<?php

use Faker\Generator as Faker;

$factory->define(App\Support::class, function (Faker $faker) {
    return [
        'name' => $faker->name, 
        'link' => $faker->url,
        'verantwoordelijke_naam' => $faker->name,
        'verantwoordelijke_email' => $faker->email, 
        'telefoon_nr' => $faker->phoneNumber
    ];
});
