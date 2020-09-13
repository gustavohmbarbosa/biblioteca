<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Book;
use Faker\Generator as Faker;

$factory->define(Book::class, function (Faker $faker) {
  return [
    'title'            => $faker->name,
    'subtitle'         => $faker->name,
    'origin'           => $faker->word,
    'price'            => 25.36,
    'isbn'             => $faker->numerify('###-#-##-######-#'),
    'synopsis'         => $faker->sentence,
    'pages'            => $faker->numberBetween(0, 900),
    'language'         => $faker->word,
    'observations'     => $faker->sentence,
    'edition'          => $faker->numberBetween(1, 20),
    'publication_year' => $faker->date($format = 'Y', $max = 'now'),
    'color'            => $faker->word,
    'cdd'              => $faker->numerify('###'),
    'cape'             => $faker->slug,
    'company_id'       => $faker->numberBetween(1, 40),
    'slug'             => $faker->slug,
  ];
});
