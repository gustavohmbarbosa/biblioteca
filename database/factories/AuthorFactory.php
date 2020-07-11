<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use App\Model;

$factory->define(\App\Author::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'biography' => $faker->sentence,
        'image' => $faker->slug,
        'slug' => $faker->slug
    ];
});
