<?php

use App\Custom\Tests\Scenarios\AuthorScenarios;
use App\Custom\Tests\Scenarios\OauthScenarios;

class AuthorTest extends TestCase
{
    use \Illuminate\Foundation\Testing\DatabaseTransactions;

    protected $author_scenarios;

    protected $oauth_scenarios;

    protected $token;

    public function __construct()
    {
        $this->author_scenarios = new AuthorScenarios();

        $this->oauth_scenarios = new OauthScenarios();
    }

    protected function setUp()
    {
        parent::setUp();

        $this->token = $this->oauth_scenarios->token();
    }

    protected function oauthHeader()
    {
        return ['Authorization' => 'Bearer ' . $this->token];
    }

    public function testGetAuthor()
    {
        $author = $this->author_scenarios->authorWithBooks();

        $uri = route('author.show', [
            'id' => $author->id
        ]);

        $this->get($uri, $this->oauthHeader());

        $this->assertResponseOk();

        $this->seeJsonStructure([
            'data' => [
                'author' => [
                    'id', 'name', 'books' => [
                        '*' => [
                            'id', 'name', 'pages'
                        ]
                    ]
                ]
            ]
        ]);
    }

    public function testAuthorNotFound()
    {
        $uri = route('author.show', [
            'id' => 0
        ]);

        $this->get($uri, $this->oauthHeader());

        $this->assertResponseStatus(404);
    }

    public function testIndexAuthor()
    {
        $this->author_scenarios->moreThenOneAuthorWithBooks(2, 1);

        $uri = route('author.index');

        $this->get($uri, $this->oauthHeader());

        $this->assertResponseOk();

        $this->seeJsonStructure([
            'data' => [
                'authors' => [
                    '*' => [
                        'id', 'name', 'books' => [
                            '*' => [
                                'id', 'name', 'pages'
                            ]
                        ]
                    ]
                ]
            ]
        ]);
    }
}