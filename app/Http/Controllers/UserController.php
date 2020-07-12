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

  public function edit(EditUser $request, User $user)
  {
    //更新処理が実行できない。データベースも更新されていないので、saveメソッドが実行されていない。
    $user->name = $request->name;
    $user->email = $request->email;
    $user->profile = $request->profile;
    $user->save();
    return redirect()->route('users.showdetail', ['user' => $user]);
  }
}
