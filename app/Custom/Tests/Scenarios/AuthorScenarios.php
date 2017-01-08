<?php

namespace App\Custom\Tests\Scenarios;

use App\Model\Author;
use App\Model\Book;
use Illuminate\Support\Collection;

class AuthorScenarios
{
    protected function authors($numberOfAuthors = 1)
    {
        return factory(Author::class, $numberOfAuthors)->create();
    }

    private function normalizeToArray(int $qtd, $models)
    {
        return ($qtd == 1) ? [$models] : $models;
    }

    /**
     * @return Author
     */
    public function authorWithBooks(int $numberOfBooks = 3) : Author
    {
        $author = $this->authors();

        $books = factory(Book::class, $numberOfBooks)->create();

        $books = $this->normalizeToArray($numberOfBooks, $books);

        $author
            ->books()
            ->saveMany($books);

        return $author;
    }

    public function moreThenOneAuthorWithBooks(int $numberOfAuthors = 2, int $numberOfBooks = 3) : Collection
    {
        $authors = $this->authors($numberOfAuthors);

        $authors = $this->normalizeToArray($numberOfAuthors, $authors);

        foreach ($authors as $author) {

            $books = factory(Book::class, $numberOfBooks)->create();

            $books = $this->normalizeToArray($numberOfBooks, $books);

            $author
                ->books()
                ->saveMany($books);
        }

        return $authors;
    }
}