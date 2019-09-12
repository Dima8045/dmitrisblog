<?php

namespace App\Policies;

use App\Post;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * @param User $user
     * @param $post
     * @return bool
     */
    public function update(User $user, $post)
    {
        if ($user->role == 'admin' || $user->id == $post->user_id) {
            return true;
        }
    }

    /**
     * @param User $user
     * @param $post
     * @return bool
     */
    public function delete(User $user, $post)
    {
        if ($user->role == 'admin' || $user->id == $post->user_id) {
            return true;
        }
    }
}
