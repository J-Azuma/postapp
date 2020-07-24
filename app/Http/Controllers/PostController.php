<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Http\Requests\CreatePost;
use Carbon\Carbon;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use GuzzleHttp\Psr7\Stream;
use Intervention\Image\Image;

/**
 * 投稿機能に関するコントローラクラス.
 *
 */
class PostController extends Controller
{
  /**
   * post一覧を表示.
   *
   * @return post一覧ページ
   */
  public function index(Request $request)
  {
    //検索ワードが空（あるいは最初にページが表示された)場合は全件表示するようにする
   $keyword = $request->keyword;
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

    //コードが横長になり、読みにくくなるのを防ぐために変数として切り出している。
    $file_name = Carbon::now().Auth::user()->id.'.jpg';


    //storeAsメソッドはilluminate\uploadedfileを引数にとるので、intervention\imageクラスのオブジェクトである
    //resized_imageには適用できない。型変換ができるか？
    //$resized_image = \Image::make($request->image_path)->resize(300, 250)->save('public/post_images/'.$file_name.'.jpg');
    $post->image_path = basename($request->image_path->storeAs('public/post_images', $file_name));
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
