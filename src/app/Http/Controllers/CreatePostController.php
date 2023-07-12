<?php declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\CreatePostRequest;
use App\Domain\Repository\PostUploadedFileRepositoryInterface;
use App\Models\Image;
use App\Domain\Payload\CreateImagePayload;

class CreatePostController extends Controller
{
    public function __invoke(CreatePostRequest $request, PostUploadedFileRepositoryInterface $postUploadedFileRepo): RedirectResponse
    {
        $thumbnail_url = $postUploadedFileRepo->save($request->thumbnail);
        $image_url_list = $postUploadedFileRepo->saveList($request->images);

        /** @var User $user */
        $user = $request->user();
        $post = new Post();
        $post->user_id = $user->id;
        $post->title = $request->title;
        $post->body = $request->body;
        $post->thumbnail_url = $thumbnail_url;
        $post->save();


        // $image_payload_list = [];
        // foreach($image_url_list as $image_url) {
        //     $image_payload_list[] = new CreateImagePayload(post_id: $post->id, url: $image_url);
        // }

        // Image::create($image_payload_list);

        // if (!$post->save()) return response()->redirectTo('/')->with('failed_create_post', '投稿が失敗しました。');

       return response()->redirectTo('/');
    }
}
