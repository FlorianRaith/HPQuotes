<?php

/* @var $factory Factory */

use App\Quote;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Quote::class, function (Faker $faker) {
    return [
        'quote' => $faker->realText($faker->numberBetween(200, 500)),
        'author' => $faker->numberBetween(1, 4),
        'book' => $faker->numberBetween(1, 7),
        'difficulty' => $faker->numberBetween(1, 3),
        'language' => $faker->randomElement(['de', 'en'])
    ];
});
