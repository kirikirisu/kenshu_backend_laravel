<?php declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\UpdatePostRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UpdatePostController extends Controller
{
    public function __invoke(UpdatePostRequest $request): RedirectResponse | Response
    {
        /** @var string $post_id */
        $post_id = $request->route('id');

        $post = Post::query()->find($post_id);
        if (is_null($post)) return response()->view('not-found', [], 404);

        /** @var User $user */
        $user = $post->user;
        if (Auth::id() !== $user->id) return response()->redirectTo('/')->with('failed_update_post', '他のユーザーの投稿は、編集、更新、削除できません。');

        $post->title = $request->title;
        $post->body = $request->body;

        if ($post->save()) {
            return response()->redirectTo("/posts/$post_id");
        }

        return response()->redirectTo("/")->with('failed_update_post', '投稿の更新に失敗しました。');
    }
}
