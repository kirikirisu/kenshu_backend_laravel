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
       $validatedData = $request->validated();

       $user = new User();
       $user->name =  $validatedData['name'];
       $user->email =  $validatedData['email'];
       $user->password = bcrypt($validatedData['password']);
       $user->save();

       Auth::login($user);

       return response()->redirectTo('/');
    }
}
