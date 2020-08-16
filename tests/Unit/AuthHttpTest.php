<?php

namespace Tests\Feature;

use App\Post;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

/**
 * 認証機能に関するテスト.
 */
class AuthHttpTest extends TestCase
{
  use RefreshDatabase;




  /**
   * ログイン画面とユーザー登録画面にアクセスできるか確認
   *
   * @return void
   */
  public function testAuthAccess()
  {
    $response = $this->get('/register');
    $response->assertStatus(200)->assertViewIs('auth.register');

    $response = $this->get('/login');
    $response->assertStatus(200)->assertViewIs('auth.login');
    $this->assertGuest();
  }

//   public function testPostAuthSuccess()
//   {
//     // $response = $this->from('/register')->post('/regisetr', [
//     //   'name' => 'testuser',
//     //   'email' => 'email@sample.com',
//     //   'password' => 'test_pass',
//     // ]);
//     // $response->assertRedirect('/posts/index');
//     // $this->assertDatabaseHas('users',[
//     //   'name' => 'testuser',
//     //   'email' => 'email@sample.com',
//     //   'password' => bcrypt('test_pass')
//     // ]);

//     // $user = factory(User::class)->create([
//     //   'name' => 'hogehoge',
//     //   'email' => 'foobar@example.com',
//     //   'password' => bcrypt('fizzbuzz'),
//     // ]);

//     // $response = $this->post('/login', [
//     //   'email' => $user->email,
//     //   'password' => $user->password,
//     // ]);
//     // $response->assertRedirect('/');
//     // $this->assertAuthenticatedAs($user);
//   }
 }

