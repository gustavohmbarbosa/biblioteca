<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\BookReader;
use Faker\Generator as Faker;

$factory->define(BookReader::class, function (Faker $faker) {
  return [
    'reader_id' => $faker->numberBetween(1, 50),
    'book_id' => $faker->numberBetween(1, 50),
    'estimated_date' => $faker->date($format = 'Y-m-d', $min = 'now'),
    'status' => $faker->randomElement(['Ativo', 'Inativo', 'Pendente']),
  ];
});
