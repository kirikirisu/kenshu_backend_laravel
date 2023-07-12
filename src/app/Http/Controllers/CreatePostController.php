<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\CreatePostRequest;

class CreatePostController extends Controller
{
    public function __invoke(CreatePostRequest $request): RedirectResponse
    {
        $user_id = Auth::id();
        // TODO: save image to disc and get url
        $thumbnail_url = "";

        // TODO: save image to disc and get url
        // $request->images
        // TODO: save images to images tabale

        $post = $request->toPost(user_id: (string)$user_id, thumbnail_url: $thumbnail_url);
        $post->save();

       return response()->redirectTo('/');
    }
}
