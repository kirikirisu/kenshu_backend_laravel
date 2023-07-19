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

        /** @var Post $post */
        $post = Post::find($post_id);
        $post->title = $request->title;
        $post->body = $request->body;

        if ($post->save()) {
            return response()->redirectTo("/posts/$post_id");
        }

        return response()->redirectTo("/")->with('failed_update_post', '投稿の更新に失敗しました。');
    }
}
