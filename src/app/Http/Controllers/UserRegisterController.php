<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\UserRegisterRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class UserRegisterController extends Controller
{
    public function index(UserRegisterRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        return response()->redirectTo("/");
    }
}
