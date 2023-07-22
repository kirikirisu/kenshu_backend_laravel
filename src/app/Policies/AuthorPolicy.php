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

    public function view(User $user, Post $post)
    {
        return $user->id === $post->user->id;
    }

    public function update(User $user, User $post_user)
    {
        return $user->id === $post_user->id;
    }
}
