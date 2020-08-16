<?php

namespace Tests\Unit;

use App\Post;
use App\User;
use Symfony\Component\VarDumper\Cloner\Data;
use Tests\TestCase;

/**
 * 投稿機能についてテストを実施する
 */
class PostTest extends TestCase
{
  /**
   * 投稿の詳細画面表示機能をテスト。。
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

    $response = $this->actingAs($user)->post('/posts/delete/' . $post->id);
    $response->assertOk();
  }

  /**
   * 投稿作成機能のテスト
   *
   * @return void
   */
  public function testCreatePost()
  {
    $user = factory(User::class)->create();

    $response = $this->actingAs($user)->post('/posts/create', [
      'title' => 'sample',
      'content' => 'foobarfizzbuzz',
      'user_id' => $user->id,
    ]);
    $response->assertRedirect('/posts/index');
    $this->assertDatabaseHas('posts', ['title' => 'sample']);
  }
}
