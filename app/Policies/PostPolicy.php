<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Post;
use Illuminate\Support\Facades\Auth;

/**
 * Postモデルを元とするポリシークラス.
 */
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

    public function view(Post $post)
    {
      return $post->user_id === Auth::user()->id;
    }
}
