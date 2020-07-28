<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Comment;
use App\Http\Requests\CreateComment;
use App\Mail\CommentPosted;
use App\User as AppUser;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class CommentController extends Controller
{
  /**
   * コメントを作成する.
   *
   * @param CreateComment $request リクエストフォームオブジェクト
   * @param Post $post コメントと紐づいた投稿
   * @return void コメントと紐づいた投稿の詳細ページ
   */
  public function create(CreateComment $request, Post $post)
  {
    $comment = new Comment();
    $comment->content = $request->content;
    $comment->user_id = Auth::user()->id;
    //ここでpost->user_id == $user->idとなるユーザーにメールを送信する
    Mail::to(User::find($post->user_id))->send(new CommentPosted(User::find($comment->user_id), $comment, $post));
    $post->comments()->save($comment);
    return redirect()->route('posts.showdetail', ['post' => $post,]);
  }
}
