<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use App\Http\Requests\LoginUserRequest;

class LoginUserController extends Controller
{
    public function __invoke(LoginUserRequest $request): RedirectResponse
    {


       return response()->redirectTo('/');
    }
}
