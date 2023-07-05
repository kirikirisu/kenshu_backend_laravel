<?php declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\RegisterUserRequest;
use Illuminate\Http\RedirectResponse;

class RegisterUserController extends Controller
{
    public function index(RegisterUserRequest $request): RedirectResponse
    {

       return response()->redirectTo('http://localhost:8888');
    }
}
