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

    public function testSaveAuthor()
    {
        $uri = route('author.save');

        $post_data = [
            'author' => [
                'name' => 'George Orwell'
            ]
        ];

        $this->post($uri, $post_data, $this->oauthHeader());

        $this->assertResponseOk();

        $this->seeInDatabase('authors', $post_data['author']);
    }

    public function testSaveAuthorValidationFails()
    {
        $uri = route('author.save');

        $post_data = [
            'author' => [
                'name' => null
            ]
        ];

        $this->post($uri, $post_data, $this->oauthHeader());

        $this->assertResponseStatus(422);

        $this->seeJsonEquals([
            'errors' => [
                'author.name' => ['The author.name field is required.']
            ]
        ]);

        $this->notSeeInDatabase('authors', $post_data['author']);
    }

    public function testUpdateAuthor()
    {
        $author = $this->author_scenarios->authorWithBooks();

        $uri = route('author.update', [
            'id' => $author->id
        ]);

        $post_data = [
            'author' => [
                'name' => 'Neil Gaiman'
            ]
        ];

        $this->put($uri, $post_data, $this->oauthHeader());

        $this->assertResponseOk();

        $this->seeJsonEquals([
            'data' => [
                'message' => 'Autor atualizado com sucesso.'
            ]
        ]);

        $this->seeInDatabase('authors', $post_data['author']);
    }

    public function testUpdateInvalidAuthor()
    {
        $uri = route('author.update', [
            'id' => 0
        ]);

        $post_data = [
            'author' => [
                'name' => 'Neil Gaiman'
            ]
        ];

        $this->put($uri, $post_data, $this->oauthHeader());

        $this->assertResponseStatus(422);

        $this->seeJsonEquals([
            'errors' => [
                'author.id' => ['The selected author.id is invalid.']
            ]
        ]);

        $this->notSeeInDatabase('authors', $post_data['author']);
    }

    public function testDeleteAuthor()
    {
        $author = $this->author_scenarios->authorWithBooks();

        $uri = route('author.delete', [
            'id' => $author->id
        ]);

        $this->delete($uri, [], $this->oauthHeader());

        $this->assertResponseOk();

        $this->notSeeInDatabase('authors', [
            'id' => $author->id
        ]);
    }
}