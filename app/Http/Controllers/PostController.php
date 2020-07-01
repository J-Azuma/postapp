<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class PostController extends Controller
{
  /**
   * post一覧を表示.
   *
   * @return post一覧ページ
   */
    public function index()
    {
      $posts = Post::all();
      return view('posts.index', [
        'posts' => $posts,
      ]);
    }

    /**
     * post作成用ページを表示.
     *
     * @return 投稿作成用フォーム
     */
    public function showCreateForm()
    {
      return view('posts.create');
    }
}
