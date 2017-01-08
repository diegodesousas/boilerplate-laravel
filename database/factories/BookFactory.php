<?php

use App\Model\Book;
use Faker\Generator;

$factory->define(Book::class, function(Generator $faker) {

    return [
        'name' => $faker->firstName,
        'pages' => $faker->randomDigit
    ];
});