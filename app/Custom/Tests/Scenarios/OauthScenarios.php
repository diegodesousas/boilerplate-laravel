<?php

namespace App\Custom\Tests\Scenarios;

use App\Model\User;
use Laravel\Passport\Client;
use Laravel\Passport\PersonalAccessClient;
use Laravel\Passport\PersonalAccessTokenFactory;

class OauthScenarios
{
    public function client($secret = null)
    {
        return factory(Client::class)->create([
            'secret' => $secret ?? 'clien_secret_default'
        ]);
    }

    public function token()
    {
        $token_factory = app()->make(PersonalAccessTokenFactory::class);

        $this->personalClient();

        $user = factory(User::class)->create();

        return $token_factory->make($user->id, 'token_default')->accessToken;
    }

    public function personalClient()
    {
        return factory(PersonalAccessClient::class)->create();
    }
}