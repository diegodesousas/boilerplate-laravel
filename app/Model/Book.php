<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $table = 'books';

    protected $fillable = [
        'id',
        'name',
        'pages'
    ];

    public function authors()
    {
        return $this->belongsToMany(Author::class, 'relation_authors_books', 'book_id', 'author_id');
    }
}
