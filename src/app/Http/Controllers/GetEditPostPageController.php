<?php declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class GetEditPostPageController extends Controller
{
    public function __invoke(Request $request): View | RedirectResponse
    {
        /** @var string $post_id */
        $post_id = $request->route('id');
        $post = Post::query()->find($post_id);
        if (is_null($post)) return response()->redirectTo('/');

        /** @var User $user */
        $user = $post->user;
        if (Auth::id() !== $user->id) return response()->redirectTo('/');

        return view('post-edit', ['post' => $post]);
    }
}
