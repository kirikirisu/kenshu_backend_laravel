<?php declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\RegisterUserRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class RegisterUserController extends Controller
{
    public function __invoke(RegisterUserRequest $request): RedirectResponse
    {
       $user = $request->toUser();
       $user->save();

       Auth::login($user);

       return response()->redirectTo('/');
    }
}
