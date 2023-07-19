<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdatePostRequest;
use Illuminate\Http\RedirectResponse;
use App\Models\Post;

class UpdatePostController extends Controller
{
    public function __invoke(UpdatePostRequest $request): RedirectResponse 
    {
        $post_id = $request->route('id');

        Post::where('id', $post_id)->update([
            'title' => $request->title,
            'body' => $request->body
        ]);

        return response()->redirectTo('/posts/' . $post_id);
    }
}
