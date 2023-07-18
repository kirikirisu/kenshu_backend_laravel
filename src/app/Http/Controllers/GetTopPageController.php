<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;

class GetTopPageController extends Controller
{
    public function __invoke(Request $request)
    {
        $tags = Tag::all();

        return view('top', ['tags' => $tags]);
    }
}
