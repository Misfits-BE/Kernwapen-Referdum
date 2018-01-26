<?php

use Faker\Generator as Faker;

$factory->define(App\Notitions::class, function (Faker $faker) {
    return [
        'author_id'     => function () {
            return factory(App\User::class)->create()->id;
        },
        'city_id'       => function () {
            return factory(App\City::class)->create()->id;
        },
        'status'        => $faker->numberBetween(0, 4),
        'titel'         => $faker->realText(10),
        'beschrijving'  => $faker->realText(50),
    ];
});
