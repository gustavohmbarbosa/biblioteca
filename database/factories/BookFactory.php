<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use App\Model;

$factory->define(\App\Book::class, function (Faker $faker) {
    return [
        'title' => $faker->name,
        'subtitle' => $faker->name,
        'origin' => $faker->word,
        'price' => 25.36,
        'isbn' => $faker->numerify('###-#-##-######-#'),
        'synopsis' => $faker->sentence,
        'pages' => $faker->numberBetween(0, 900),
        'language' => $faker->word,
        'observations' => $faker->sentence,
        'edition' => $faker->numberBetween(1, 20),
        'publication_date' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'color' => $faker->word,
        'cdd' => $faker->numerify('###'),
        'cape' => $faker->slug,
        'company' => $faker->name,
        'author_id' => $faker->numberBetween(1, 20),
        'slug' => $faker->slug,
    ];
});
