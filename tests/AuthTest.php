<?php

use App\Custom\Tests\Scenarios\OauthScenarios;
use App\Custom\Tests\Scenarios\UserScenarios;

class AuthTest extends TestCase
{
    use \Illuminate\Foundation\Testing\DatabaseTransactions;

    /**
     * @var OauthScenarios
     */
    protected $oauth_scenario;

    /**
     * @var UserScenarios
     */
    protected $user_scenario;

    public function setUp()
    {
        parent::setUp();

        $this->oauth_scenario = new OauthScenarios();

        $this->user_scenario = new UserScenarios();
    }

    public function testAuthenticateUserSuccess()
    {
        $secret = 'abacate';

        $client = $this->oauth_scenario->client($secret);

        $password = 'abacate';

        $user = $this->user_scenario->user([
            'password' => bcrypt($password)
        ]);

        $this->post('oauth/token', [
            'grant_type' => 'password',
            'client_id' => $client->id,
            'client_secret' => $secret,
            'username' => $user->email,
            'password' => $password
        ]);

        $this->assertResponseOk();

        $this->seeJsonStructure([
            'token_type',
            'expires_in',
            'access_token',
            'refresh_token',
        ]);

        $response = $this->decodeResponseJson();

        $this->get('/api/user', [
            'Authorization' => $response['token_type'] . ' ' . $response['access_token']
        ]);

        $this->assertResponseOk();

        $this->seeJsonStructure([
            'id',
            'name',
            'email',
            'updated_at',
            'created_at'
        ]);
    }

    public function testAuthenticateUserFailed()
    {
        $secret = 'abacate';

        $client = $this->oauth_scenario->client($secret);

        $password = 'abacate';

        $user = $this->user_scenario->user([
            'password' => bcrypt($password)
        ]);

        $this->post('oauth/token', [
            'grant_type' => 'password',
            'client_id' => $client->id,
            'client_secret' => $secret,
            'username' => $user->email,
            'password' => 'senha-errada'
        ]);

        $this->seeStatusCode(401);
    }
}