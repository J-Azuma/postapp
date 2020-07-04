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
      $posts = Post::all()->sortByDesc('id');
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

    /**
     * 投稿作成を行う.
     *
     * @param Request $request
     * @return void 投稿一覧画面に遷移
     */
    public function create(Request $request) {
      $post= new Post();
      $post->title = $request->title;
      $post->content = $request->content;
      $post->save();
      return redirect()->route('posts.index', [
        'posts' => Post::all()->sortByDesc('id'),
      ]);
    }

    /**
     * 投稿詳細画面を表示する
     *
     * @param Post $post
     * @return void
     */
    public function showDetail(Post $post)
    {
      return view('posts.showdetail', ['post' => $post,]);
    }

}
