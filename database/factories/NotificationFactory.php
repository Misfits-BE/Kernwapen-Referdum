<?php

use Carbon\Carbon;
use Faker\Generator as Faker;
use Illuminate\Notifications\DatabaseNotification;
use App\User;

$factory->define(DatabaseNotification::class, function (Faker $faker) {
    return [
        'id' => $faker->uuid,
        'type' => $faker->word,
        'notifiable_id' => factory(User::class)->create()->id,
        'notifiable_type' => '\Misfits\User',
        'data' => json_encode(['a' => '2', 'b' => '4']),
    ];
});
