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
        $posts = Post::query()->take(10)->get();

        return view('top', ['posts' => $posts, 'tags' => $tags]);
    }
}
