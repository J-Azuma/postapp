<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

/**
 * ユーザークラスを元とするポリシークラス.
 *
 */
class UserPolicy
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
     * idがログインしているユーザーと同じものか確認.
     *
     * @param User $user
     * @return void
     */
    public function view(User $user)
    {
      return $user->id == Auth::user()->id;
    }
}
