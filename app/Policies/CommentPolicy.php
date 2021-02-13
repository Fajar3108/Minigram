<?php

namespace App\Policies;

use App\Models\{User, Comment};
use Illuminate\Auth\Access\HandlesAuthorization;

class CommentPolicy
{
    public function delete(User $user, Comment $comment)
    {
        return $user->id === $comment->user_id || $user->role == "admin";
    }
}
