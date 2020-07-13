<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Http\Requests\CreatePost;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
  /**
   * post一覧を表示.
   *
   * @return post一覧ページ
   */
  public function index(Request $request)
  {
   $keyword = $request->input('keyword');
   if ($keyword == null) {
     $keyword = "";
   }
    //postsテーブルのレコードをidの降順に取得してpaginate関数を使って1ページあたり10件表示したい。
    $posts = Post::where('content', 'like', '%'.$keyword.'%')->orderBy('id', 'desc')->paginate(10);
    return view('posts.index',
    ['posts' => $posts, 'keyword' => $keyword]);
  }


  /**
   * 投稿作成を行う.
   *
   * @param Request $request
   * @return void 投稿一覧画面に遷移
   */
  public function create(CreatePost $request)
  {
    $post = new Post();
    $post->title = $request->title;
    $post->content = $request->content;
    $post->user_id = Auth::user()->id;
    $post->save();
    return redirect()->route('posts.index', [
      'posts' => Post::all()->sortByDesc('id'),
    ]);
  }

  /**
   * 投稿詳細画面を表示する.
   *
   * @param Post $post
   * @return void
   */
  public function showDetail(Post $post)
  {
    return view('posts.showdetail', ['post' => $post,]);
  }

  /**
   * 投稿を削除する.
   *
   * @param Post $post 削除する投稿
   * @return void
   */
  public function delete(Post $post)
  {
    $post->delete();
    return redirect()->route('posts.index', [
      'posts' => Post::all()->sortByDesc('id'),
    ]);
  }
}
