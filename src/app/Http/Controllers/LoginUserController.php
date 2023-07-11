<?php declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use App\Http\Requests\LoginUserRequest;
use Illuminate\Support\Facades\Auth;

class LoginUserController extends Controller
{
    public function __invoke(LoginUserRequest $request): RedirectResponse
    {
       $credentials = ['email' => $request->email, 'password' => $request->password];

       if (Auth::attempt($credentials)) {
          $request->session()->regenerate();

          return response()->redirectTo('/');
       }

       return response()->redirectTo('/login');
    }
}
