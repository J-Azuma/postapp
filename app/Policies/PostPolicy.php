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

    /**
     * 投稿削除の認可を行う.
     *
     * @param Post $post
     * @return void
     */
    public function delete(Post $post)
    {
      return Auth::user()->id === $post->user_id;
    }
}
