<?php declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use App\Models\Tag;
use App\Models\Post;
use App\Models\User;

class GetTopPageController extends Controller
{
    public function __invoke(): View
    {
        $tags = Tag::all();
        $posts = Post::query()->with('tags')->with('user')->paginate(10);

        return view('top', ['posts' => $posts, 'tags' => $tags]);
    }
}
