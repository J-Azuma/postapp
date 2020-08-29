<?php

namespace Tests\Unit;

use App\Post;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Symfony\Component\VarDumper\Cloner\Data;
use Tests\TestCase;

/**
 * 投稿機能についてテストを実施する
 */
class PostTest extends TestCase
{
  use RefreshDatabase;
  /**
   * 投稿の詳細画面表示機能をテスト.
   *
   * @return void
   */
  public function testShowPost()
  {
    $post = factory(Post::class)->create();
    $user = factory(User::class)->create();

    $response = $this->get('/posts/detail/' . $post->id);
    $response->assertStatus(200);

    $response = $this->get('/posts/detail/90000000000');
    $response->assertStatus(404);
  }

  /**
   * 投稿作成機能のテスト
   *
   * @return void
   */
  public function testCreatePostSuccess()
  {
    $user = factory(User::class)->create();

    $response = $this->actingAs($user)->post('/posts/create', [
      'title' => 'aaaaaaaaaaaaaaaaaaaa',
      'content' => Str::random(200),
      'user_id' => $user->id,
    ]);
    $response->assertRedirect('/posts/index');
    $this->assertDatabaseHas('posts', ['title' => 'aaaaaaaaaaaaaaaaaaaa']);
  }

  /**
   * 投稿作成機能のテスト(バリデーションチェックのテスト)
   *
   * @return void
   */
  public function testCreatePostFail()
  {
    //タイトルが未入力
    $user = factory(User::class)->create();

    $response = $this->actingAs($user)->post('/posts/create', [
      'title' => Str::random(0),
      'content' => 'hogehoge',
      'user_id' => $user->id,
    ]);
    $response->assertRedirect('/');
    $this->assertDatabaseMissing('posts', ['content' => 'hogehoge',]);

    //タイトルの文字数が上限値を超えている
    $response = $this->actingAs($user)->post('/posts/create', [
      'title' => Str::random(21),
      'content' => 'hugahuga',
      'user_id' => $user->id,
    ]);
    $response->assertRedirect('/');
    $this->assertDatabaseMissing('posts', ['content' => 'hogehoge',]);

    //contentが空
    $response = $this->actingAs($user)->post('/posts/create', [
      'title' => 'content_null',
      'content' => Str::random(0),
      'user_id' => $user->id,
    ]);
    $response->assertRedirect('/');
    $this->assertDatabaseMissing('posts', ['title' => 'content_null',]);

    //contentが上限値を超えている
    $response = $this->actingAs($user)->post('/posts/create', [
      'title' => 'content_over',
      'content' => Str::random(201),
      'user_id' => $user->id,
    ]);
    $response->assertRedirect('/');
    $this->assertDatabaseMissing('posts', ['title' => 'content_over',]);
  }

  /**
   * 投稿削除機能のテスト.
   *
   * @return void
   */
  public function testDeletePostSuccess()
  {

    $user = factory(User::class)->create();
    $post = factory(Post::class)->create([
      'user_id' => $user->id,
    ]);
    $this->assertDatabaseHas('posts', ['title' => $post->title]);
    $response = $this->actingAs($user)->from('/posts/detail/'.$post->id)->post('/posts/delete/'.$post->id);
    $response->assertRedirect('/posts/index');
    $this->assertDatabaseMissing('posts', ['title' => $post->title]);
  }
}
