<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class UpdatePostController extends Controller
{
    public function __invoke(Request $request): RedirectResponse
    {
        $post_id = $request->input('id');

        return response()->redirectTo('/');
    }
}
