<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Comment;
use App\Http\Requests\CreateComment;
use Illuminate\Support\Facades\Auth;

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
    echo $post->id;
    $comment = new Comment();
    $comment->content = $request->content;
    $comment->user_id = Auth::user()->id;
    $post->comments()->save($comment);
    return redirect()->route('posts.showdetail', ['post' => $post,]);
  }
}
