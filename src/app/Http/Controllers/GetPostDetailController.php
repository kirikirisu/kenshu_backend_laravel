<?php declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;

class GetPostDetailController extends Controller
{
    public function __invoke(Request $request): View
    {
        /** @var string $post_id */
        $post_id = $request->route('id');

        return view('post-detail');
    }
}
