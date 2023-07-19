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

        Post::where('id', $post_id)->update([
            'title' => $request->title,
            'body' => $request->body
        ]);

        return response()->redirectTo("/posts/$post_id");
    }
}
