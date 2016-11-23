<?php

namespace App\Http\Controllers;

use App\Model\Author;

class AuthorController extends Controller
{
    public function show($id)
    {
        $author = Author::find($id);

        $content = [
            'data' => [
                'author' => $author
            ]
        ];

        return response()->json($content);
    }
}