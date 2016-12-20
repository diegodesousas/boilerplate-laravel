<?php

use Laravel\Passport\Client;
use Laravel\Passport\PersonalAccessClient;

$factory->define(Client::class, function (Faker\Generator $faker) {

    return [
        'name' => 'client_test',
        'secret' => 'client_secret_test',
        'personal_access_client' => true,
        'password_client' => true,
        'revoked' => false,
        'redirect' => '/redirect'
    ];
});

$factory->define(PersonalAccessClient::class, function (Faker\Generator $faker) {

    return [
        'client_id' => function() {

            return factory(Client::class)->create()->id;
        }
    ];
});

