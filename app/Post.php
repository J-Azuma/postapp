<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Post extends Model
{
  public function comments()
  {
    return $this->hasMany('App\Comment');
  }

  /**
   * 1つのpostインスタンスに複数のlikeモデルが紐づく.
   *
   * @return void
   */
  public function likes()
  {
    return $this->hasMany('App\Like');
  }

  public function is_liked_by_auth_user()
  {
    $user_id = Auth::id();

    $likers = array();
    foreach ($this->likes as $like) {
      array_push($likers, $like->user_id);
    }

    if (in_array($user_id, $likers)) {
      return true;
    } else {
      return false;
    }

  }
}
