<?php declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\RegisterUserRequest;
use Illuminate\Http\RedirectResponse;

class RegisterUserController extends Controller
{
    public function __invoke(RegisterUserRequest $request): RedirectResponse
    {
       $validatedData = $request->validated();
       $validatedData['password'] = bcrypt($request->password);
       $request->session()->put('user_id', 1);

       return response()->redirectTo('http://localhost:8888');
    }
}
