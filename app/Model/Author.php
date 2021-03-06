<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    protected $table = 'authors';

    protected $fillable = [
        'id',
        'name'
    ];

    public $timestamps = false;

    public $with = ['books'];

    protected $hidden = ['pivot'];

    public function books()
    {
        return $this->belongsToMany(Book::class, 'relation_authors_books', 'author_id', 'book_id');
    }
}
