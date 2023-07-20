<?php declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Models\Tag;
use App\Models\Post;

class GetTopPageController extends Controller
{
    public function __invoke(): View
    {
        $tags = Tag::all();
        $posts = Post::query()->get()->take(10);

        // foreach($posts as $post) {
        //     $image = $post->images();
        //     $tag = $post->tags();
        // }

        return view('top', ['posts' => $posts, 'tags' => $tags]);
    }
}
