<?php

use Faker\Generator as Faker;
use App\User;

$factory->define(App\Article::class, function (Faker $faker) {
    return [
        'author_id' => factory(User::class)->create()->id,
        'title' => $faker->title,
        'slug' => $faker->slug,
    ];
});
