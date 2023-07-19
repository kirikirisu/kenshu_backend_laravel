<?php declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class DeletePostController extends Controller
{
    public function __invoke(Request $request): RedirectResponse
    {
        return response()->redirectTo("/")->with('failed_delete_post', '投稿の削除に失敗しました。');
    }
}
