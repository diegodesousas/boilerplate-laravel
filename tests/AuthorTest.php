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

        $this->get('api/author/' . $author->id);

        $this->assertResponseOk();
    }
}