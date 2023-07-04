<?php
namespace App\Repositories;

use App\Interfaces\UserRepositoryInterface;
use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
    public function insertUser(array $payload)
    {
        return User::create($payload);
    }

}
