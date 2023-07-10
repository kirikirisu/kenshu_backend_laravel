<?php declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\RegisterUserRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class RegisterUserController extends Controller
{
    public function __invoke(RegisterUserRequest $request): RedirectResponse
    {
       $user = new User();
       $user->name =  $request->name;
       $user->email =  $request->email;
       $user->password = bcrypt($request->password);
       $user->save();

       Auth::login($user);

       return response()->redirectTo('/');
    }
}
