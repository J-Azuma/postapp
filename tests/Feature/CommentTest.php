<?php

namespace Tests\Feature;

use App\Post;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\TestCase;


class CommentTest extends TestCase
{
  use RefreshDatabase;

  /**
   * コメント作成機能のテスト(成功).
   *
   * @return void
   */
  public function testCreateCommentSuccess()
  {
    $user = factory(User::class)->create();
    $post = factory(Post::class)->create();

    $this->assertDatabaseMissing('comments', ['content' => 'content']);
    $response = $this->from('/posts/detail/' . $post->id)->actingAs($user)->post('/comments/create/' . $post->id, [
      'content' => str_repeat("a", 100),
      'post_id' => $post->id,
    ]);
    $response->assertRedirect('posts/detail/' . $post->id);
    $this->assertDatabaseHas('comments', ['content' => str_repeat("a", 100)]);
  }


  /**
   * コメント作成失敗テスト. ログインユーザーのIDとpostユーザーのIDが一致している場合、
   * コメントが投稿できないような仕様だが、その場合コメント作成フォームが表示されないので
   * テストの必要はないと判断した.
   *
   * @return void
   */
  public function testCommentFail()
  {
    $user = factory(User::class)->create();
    $post = factory(Post::class)->create();

    //文字数が上限を超えている.
    $response = $this->from('/posts/detail/' . $post->id)->actingAs($user)->post('/comments/create/' . $post->id, [
      'content' => str_repeat("a", 101),
      'post_id' => $post->id,
    ]);
    $response->assertRedirect('posts/detail/' . $post->id);
    $this->assertDatabaseMissing('comments', ['content' => str_repeat("a", 101)]);

    //内容が空
    $response = $this->from('/posts/detail/' . $post->id)->actingAs($user)->post('/comments/create/' . $post->id, [
      'content' => '',
      'post_id' => $post->id,
    ]);
    $response->assertRedirect('posts/detail/' . $post->id);
    $this->assertDatabaseMissing('comments', ['content' => str_repeat("a", 101)]);
  }
}
