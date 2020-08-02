<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
}
