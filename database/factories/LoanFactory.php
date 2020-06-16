<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Loan;
use Faker\Generator as Faker;

$factory->define(Loan::class, function (Faker $faker) {
    return [
        'estimated_date' => $faker->date($format = 'Y-m-d', $max = 'now'),
    ];
});
