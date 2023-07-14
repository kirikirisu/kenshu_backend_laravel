<?php declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\CreatePostRequest;
use App\Domain\Repository\PostUploadedFileRepositoryInterface;
use App\Models\Image;
use Exception;
use Illuminate\Support\Facades\DB;
use App\Util\UploadFileDtoList;

class CreatePostController extends Controller
{
    public function __invoke(CreatePostRequest $request, PostUploadedFileRepositoryInterface $postUploadedFileRepo): RedirectResponse
    {
        $thumbnail_result = $postUploadedFileRepo->save($request->thumbnail);
        if (!$thumbnail_result->upload_success) return response()->redirectTo('/')->with('failed_create_post', 'サムネイルのアップロードに失敗し投稿が失敗しました。');

        $uploadFileDtoList = $postUploadedFileRepo->saveList($request->images); 
        if (!$uploadFileDtoList->isAllSuccess()) return response()->redirectTo('/')->with('failed_create_post', '画像のアップロードに失敗し投稿が失敗しました。');

        try {
            DB::beginTransaction();

            /** @var User $user */
            $user = $request->user();
            $post = new Post();
            $post->user_id = $user->id;
            $post->title = $request->title;
            $post->body = $request->body;
            $post->thumbnail_url = (string)$thumbnail_result->file_path;
            $post->save();

            Image::bulkInsert(post_id: $post->id, uploaded_image_list: $uploadFileDtoList->getUploadedFile());

            DB::commit();

            return response()->redirectTo('/');
        } catch (Exception $e) {
            DB::rollBack();

            return response()->redirectTo('/')->with('failed_create_post', '投稿に失敗しました。');
        }
    }

}
