<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Interfaces\UserRepositoryInterface;

class UserRegisterController extends Controller
{
    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository) {
        $this->userRepository = $userRepository;
    }

    public function index(Request $request) {
        $user = $request->only(['name', 'email', 'password']);

        $insertedUser = $this->userRepository->insertUser($user);

        return response()->json([
            'data' => $insertedUser
        ],
            Response::HTTP_CREATED
        );
    }
}
