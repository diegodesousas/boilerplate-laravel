<?php

namespace App\Http\Controllers;

use App\Http\Requests\Author\AuthorRequest;
use App\Model\Author;

class AuthorController extends Controller
{
    public function show(AuthorRequest $request)
    {
        return rest_response([
            'author' => $request->getAuthor()
        ]);
    }

    public function index()
    {
        return rest_response([
            'authors' => Author::all()
        ]);
    }
}