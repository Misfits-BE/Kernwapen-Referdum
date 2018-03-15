<?php

use App\User;
use Faker\Generator as Faker;
use Misfits\ApiGuard\Models\ApiKey;

$factory->define(ApiKey::class, function (Faker $faker) {
    return [
        'apikeyable_id'     => factory(User::class)->create()->id,
        'apikeyable_type'   => 'App\User',
        'key'               => str_random(50),
        'service'           => $faker->name,
        'last_ip_address'   => $faker->ipv4,
        'last_used_at'      => $faker->dateTime,
    ];
});
