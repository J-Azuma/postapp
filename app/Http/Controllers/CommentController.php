<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Comment;
use App\Http\Requests\CreateComment;

class CommentController extends Controller
{
  public function create(CreateComment $request, Post $post)
  {
    echo $post->id;
    $comment = new Comment();
    $comment->content = $request->content;
    $post->comments()->save($comment);
    return redirect()->route('posts.showdetail', ['post' => $post,]);
  }
}
