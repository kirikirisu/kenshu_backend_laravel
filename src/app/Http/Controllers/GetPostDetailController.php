<?php declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\User;

class GetPostDetailController extends Controller
{
    public function __invoke(Request $request): View | RedirectResponse
    {
        /** @var string $post_id */
        $post_id = $request->route('id');
        $post = Post::find($post_id);
        if (is_null($post)) return response()->redirectTo('/');
        
        /** @var User $user */
        $user = $post->user;
        $is_author = Auth::id() === $user->id;

        return view('post-detail', ['post' => $post, 'is_author' => $is_author]);
    }
}
