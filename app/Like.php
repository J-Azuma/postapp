<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * like状態保持するモデルクラス.
 */
class Like extends Model
{

  /**
   * 書き込み可能なプロパティを配列に格納する.
   *
   * @var array
   */
  protected $fillable = ['post_id', 'user_id'];
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
