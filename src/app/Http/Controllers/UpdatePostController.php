<?php declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\UpdatePostRequest;
use Illuminate\Http\RedirectResponse;
use App\Models\Post;

class UpdatePostController extends Controller
{
    public function __invoke(UpdatePostRequest $request): RedirectResponse 
    {
        /** @var string $post_id */
        $post_id = $request->route('id');

        $post = Post::query()->find($post_id);
        if (is_null($post)) return response()->redirectTo("/")->with('failed_update_post', '投稿が見つかりませんでした。');

        $post->title = $request->title;
        $post->body = $request->body;

        if ($post->save()) {
            return response()->redirectTo("/posts/$post_id");
        }

        return response()->redirectTo("/")->with('failed_update_post', '投稿の更新に失敗しました。');
    }
}
