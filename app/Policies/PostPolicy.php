<?php

namespace App\Policies;

use App\Models\{User, Post};
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    public function update(User $user, Post $post)
    {
        return $user->id === $post->user_id || $user->role == "admin";
    }

    public function delete(User $user, Post $post)
    {
        return $user->id === $post->user_id || $user->role == "admin";
    }
}
