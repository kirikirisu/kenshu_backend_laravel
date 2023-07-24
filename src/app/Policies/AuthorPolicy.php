<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Post;

class AuthorPolicy
{
    public function __construct()
    {
    }

    /**
     * @param User $user
     * @param Post $post
     * @return bool
     */
    public function view(User $user, Post $post): bool
    {
        return $post->user && $user->id === $post->user->id;
    }

    public function update(User $user, Post $post): bool
    {
        return $post->user && $user->id === $post->user->id;
    }
    
    public function delete(User $user, Post $post): bool
    {
        return $post->user && $user->id === $post->user->id;
    }
}
