<?php declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\CreatePostRequest;
use App\Domain\Repository\PostUploadedFileRepositoryInterface;

class CreatePostController extends Controller
{
    public function __invoke(CreatePostRequest $request, PostUploadedFileRepositoryInterface $post_image_bin_repo): RedirectResponse
    {
        $thumbnail_url = $post_image_bin_repo->saveThumbnail($request->thumbnail);
        $image_url_list = $post_image_bin_repo->saveMultiImage($request->images);

        $post = new Post();
        $post->user_id = (string)auth()->id();
        $post->title = $request->title;
        $post->body = $request->body;
        $post->thumbnail_url = $thumbnail_url;

        if (!$post->save()) return response()->redirectTo('/')->with('failed_create_post', '投稿が失敗しました。');

       return response()->redirectTo('/');
    }
}
