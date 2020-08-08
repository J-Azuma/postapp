<?php

namespace Tests\Feature;

use App\Post;
use App\User;
use Faker\Factory;
use Faker\Provider\ar_JO\Text;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Support\Traits\ReflectsClosures;
use Tests\TestCase;

/**
 * 認証が不要なurlのテスト.
 *
 */
class PracticeTest extends TestCase
{
  use RefreshDatabase;
  /**
   * A basic feature test example.
   *
   * @return void
   */
  public function testExample()
  {
    $test_user = factory(User::class)->create();
    $test_post = factory(Post::class)->create();


    $response = $this->get('/');
    $response->assertStatus(200)->assertViewIs('posts.index');


    $response = $this->get('/posts/index');
    $response->assertStatus(200)->assertViewIs('posts.index');


    $response = $this->get('/posts/detail/11111111');
    $response->assertStatus(404);

    $response = $this->get('/posts/detail/'.$test_post->id)->assertStatus(200);

    //テストデータが存在することは確認できた。
    $this->assertDatabaseHas(
      'users',
      [
        'id' => $test_user->id,
        'name' => $test_user->name,
        'email' => $test_user->email,
        'password' =>  $test_user->password,
        'remember_token' => $test_user->remember_token,
      ]
    );

    //404ステータスが返される。userインスタンスが注入されていないのか?。
    $response = $this->get('/users/detail/'.$test_user->id);
    $response->assertStatus(200);

    $response = $this->get('/users/detail/30000000');
    $response->assertStatus(404);
  }
}
