<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\EditUser;

class UserController extends Controller
{

  /**
   * ユーザー詳細画面へのルーティング
   *
   * @param User $user
   * @return void
   */
  public function showDetail(User $user)
  {
    return view('users.showdetail', [
      'user' => $user,
    ]);
  }

  /**
   * ユーザー情報編集画面へのルーティング
   *
   * @param User $user
   * @return void
   */
  public function showEditForm(User $user)
  {
    return view(
      'users.showeditform',
      ['user' => $user]
    );
  }

  public function edit(EditUser $request)
  {
    $user = Auth::user();
    $user->name = $request->name;
    $user->email = $request->email;
    $user->profile = $request->profile;
    return view('user.showdetail', ['user' => $user]);
  }
}
