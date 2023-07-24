<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Post;
use Illuminate\Auth\Access\Response;

class AuthorPolicy
{
    public function __construct()
    {
    }

    public function view(User $user, Post $post): bool
    {
        return $user->id === $post->user->id;
    }

    public function update(User $user, Post $post): bool
    {
        return $user->id === $post->user->id;
    }
    
    public function delete(User $user, Post $post): bool
    {
        return $user->id === $post->user->id;
    }
}
