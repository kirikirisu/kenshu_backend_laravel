<?php declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Post;
use Exception;

class DeletePostController extends Controller
{
    public function __invoke(Request $request): RedirectResponse
    {
        /** @var string $post_id */
        $post_id = $request->route('id');

        try {
            DB::beginTransaction();

            $post = Post::query()->find($post_id);
            if (is_null($post)) {
              DB::rollBack();
              return response()->redirectTo("/")->with('failed_delete_post', '投稿が見つかりませんでした。');
            }

            $post->images()->delete();
            $post->tags()->detach();
            $post->delete();

            DB::commit();

            return response()->redirectTo("/");
        } catch(Exception $e) {
            DB::rollBack();
            return response()->redirectTo("/")->with('failed_delete_post', '投稿の削除に失敗しました。');
        }
    }
}
