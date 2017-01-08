<?php

use App\Model\Author;
use Faker\Generator;

$factory->define(Author::class, function(Generator $faker) {

    return [
        'name' => $faker->name,
    ];
});