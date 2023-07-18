<?php declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Models\Tag;

class GetTopPageController extends Controller
{
    public function __invoke(): View
    {
        $tags = Tag::all();

        return view('top', ['tags' => $tags]);
    }
}
