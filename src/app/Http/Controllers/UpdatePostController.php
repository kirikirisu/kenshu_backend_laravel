<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class UpdatePostController extends Controller
{
    public function __invoke($request): RedirectResponse 
    {
        $post_id = $request->route('id');

        

        return response()->redirectTo('/posts/' . $post_id);
    }
}
