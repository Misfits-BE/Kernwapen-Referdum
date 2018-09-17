<?php

use Faker\Generator as Faker;
use App\User;

$factory->define(App\Article::class, function (Faker $faker) {
    return [
        'author_id' => factory(User::class)->create()->id,
        'titel' => $faker->title,
        'is_public' => $faker->boolean,
        'bericht' => $faker->paragraph,
        'slug' => $faker->slug,
    ];
});
