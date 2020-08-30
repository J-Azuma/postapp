<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

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
     * 認証済みユーザーとアクセス先のユーザーのIDが一致している場合のみアクセスを許可.
     *
     * @param User $user
     * @return void
     */
    public function view(User $user)
    {
      return (Auth::check()) && (Auth::user()->id === $user->id);
    }
}
