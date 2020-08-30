<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\EditUser;
use App\Post;

/**
 * ユーザー情報を扱うコントローラクラス.
 */
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
    $posts = Post::where('user_id', $user->id)->orderBy('id', 'desc')->paginate(10);
    return view('users.showdetail', [
      'user' => $user,
      'posts' => $posts,
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
    $this->checkUserId($user);

    return view(
      'users.showeditform',
      ['user' => $user]
    );
  }

  /**
   * ユーザー情報を更新する.
   *
   * @param EditUser $request  リクエストフォーム
   * @param User $user ユーザー
   * @return void
   */
  public function edit(EditUser $request, User $user)
  {

    $this->checkUserId($user);

    $user->name = $request->name;
    $user->email = $request->email;
    $user->profile = $request->profile;
    $user->save();
    return redirect()->route('users.showdetail', ['user' => $user]);
  }

  /**
   * ログインユーザーのIDと編集するユーザーのIDが異なる場合、アクセスを拒否
   *
   * @param User $user
   * @return void
   */
  private function checkUserId(User $user)
  {
    if ($user->id !== Auth::user()->id) {
      abort(403);
    }
  }
}
