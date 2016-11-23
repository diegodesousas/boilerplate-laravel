<?php

namespace App\Custom\Tests\Scenarios;

use App\Model\Author;
use App\Model\Book;

class AuthorScenarios
{
    /**
     * @return Author
     */
    public function authorWithBooks($numberOfBooks = 3)
    {
        $author = factory(Author::class)
            ->create();

        $books = factory(Book::class, $numberOfBooks)->create();

        $author
            ->books()
            ->saveMany($books);

        return $author;
    }
}