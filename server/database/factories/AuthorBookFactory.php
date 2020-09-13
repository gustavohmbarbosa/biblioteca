<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\AuthorBook;
use Faker\Generator as Faker;

$factory->define(AuthorBook::class, function (Faker $faker) {
  return [
    'author_id' => $faker->numberBetween(1, 50),
    'book_id'   => $faker->numberBetween(1, 50),
  ];
});
