<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{

  /**
   * 1つのlikeインスタンスは1つのpostインスタンスと紐づく.
   *
   * @return void
   */
  public function post(){
    return $this->belongsTo('App\Post');
  }

  /**
   * 1つのlikeインスタンスは1つのpostインスタンスと紐づく.
   *
   * @return void
   */
  public function user()
  {
    return $this->belongsTo('App\User');
  }
}
