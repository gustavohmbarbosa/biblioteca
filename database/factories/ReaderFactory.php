<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Reader;
use Faker\Generator as Faker;

$factory->define(Reader::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'phone' => $faker->phoneNumber,
        'gender' => 'Masculino',
        'year' => rand(1,3),
        'class' => 'A',
        'course' => 'Desenvolvimento de Sistemas',
        'registration' => $faker->unique()->postcode,
        'status' => 'ATIVO',
    ];
});
