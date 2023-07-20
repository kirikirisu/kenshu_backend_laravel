<?php declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Image;
use App\Models\PostTag;
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
            if (is_null($post)) return response()->redirectTo("/")->with('failed_delete_post', '投稿が見つかりませんでした。');

            Image::query()->where('post_id', $post->id)->delete();
            PostTag::query()->where('post_id', $post_id)->delete();
            $post->delete();

            DB::commit();

            return response()->redirectTo("/");
        } catch(Exception $e) {
            DB::rollBack();
            return response()->redirectTo("/")->with('failed_delete_post', '投稿の削除に失敗しました。');
        }
    }
}
