<?php

use App\Custom\Tests\Scenarios\AuthorScenarios;

class AuthorTest extends TestCase
{
    use \Illuminate\Foundation\Testing\DatabaseTransactions;

    protected $scenarios;
    
    public function __construct()
    {
        $this->scenarios = new AuthorScenarios();
    }

    public function testGetAuthor()
    {
        $author = $this->scenarios->authorWithBooks();

        $uri = route('author.show', [
            'id' => $author->id
        ]);

        $this->get($uri);

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
}