<?php declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\CreatePostRequest;
use App\Domain\Repository\PostUploadedFileRepositoryInterface;
use App\Models\Image;
use App\Domain\Payload\CreateImagePayload;
use App\Domain\Result\FileUploadResult;
use Exception;
use Illuminate\Support\Facades\DB;

class CreatePostController extends Controller
{
    public function __invoke(CreatePostRequest $request, PostUploadedFileRepositoryInterface $postUploadedFileRepo): RedirectResponse
    {
        $thumbnail_result = $postUploadedFileRepo->save($request->thumbnail);
        if (!$thumbnail_result->status) return response()->redirectTo('/')->with('failed_create_post', 'サムネイルのアップロードに失敗し投稿が失敗しました。');
        $image_result_list = $postUploadedFileRepo->saveList($request->images);
        if (!self::checkStatus($image_result_list)) return response()->redirectTo('/')->with('failed_create_post', '画像のアップロードに失敗し投稿が失敗しました。');

        try {
            DB::beginTransaction();

            /** @var User $user */
            $user = $request->user();
            $post = new Post();
            $post->user_id = $user->id;
            $post->title = $request->title;
            $post->body = $request->body;
            $post->thumbnail_url = $thumbnail_result->file_name;
            $post->save();

            $image_payload_list = [];
            foreach($image_result_list as $image_result) {
                $image_payload_list[] = [
                  'post_id' => $post->id,
                  'url' => $image_result->saved_file_path
                ]; 
            }

            Image::insert($image_payload_list);

            DB::commit();

            return response()->redirectTo('/');
        } catch (Exception $e) {
            DB::rollBack();

            return response()->redirectTo('/')->with('failed_create_post', '投稿に失敗しました。');
        }
    }

    /**
     * @param FileUploadResult[] $file_list
     * @return bool
     */
    private static function checkStatus(array $file_list): bool
    {
        foreach($file_list as $file)
        {
            if ($file->status) return false;
        }

        return true;
    }
}
