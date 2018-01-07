<?php

use Faker\Generator as Faker;
use App\Province;

$factory->define(App\City::class, function (Faker $faker) {
    return [
        'province_id' => function () {
            return factory(Province::class)->create()->id;
        },
        'postal' => $faker->postcode, 
        'name' => $faker->city, 
        'lat' => $faker->latitude, 
        'lng' => $faker->longitude,
        'kernwapen_vrij' => $faker->boolean
    ];
});
