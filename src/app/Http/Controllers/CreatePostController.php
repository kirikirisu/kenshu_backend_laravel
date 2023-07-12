<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePostRequest;

class CreatePostController extends Controller
{
    public function __invoke(CreatePostRequest $request)
    {
        // login check (middleware)
        var_dump($request->title);

        // toPost
        // save

       return response()->redirectTo('/');
    }
}
