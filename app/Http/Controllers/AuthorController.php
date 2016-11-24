<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthorRequest;

class AuthorController extends Controller
{
    public function show(AuthorRequest $request)
    {
        return rest_response([
            'author' => $request->getAuthor()
        ]);
    }
}