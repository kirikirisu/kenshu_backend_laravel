<?php
declare(strict_types=1);

namespace App\Interfaces;

interface UserRepositoryInterface
{
    public function insertUser(array $payload);

}
