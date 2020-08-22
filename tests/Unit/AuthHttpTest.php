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
  //テスト用DBのデータが増えるのを防ぐためにテスト実施毎にDBを初期化
  use RefreshDatabase;


  /**
   * ログイン画面とユーザー登録画面にアクセスできるか確認.
   *
   * @return void
   */
  public function testSuccessAccessToLoginAndRegister()
  {
    $response = $this->get('/register');
    $response->assertStatus(200)->assertViewIs('auth.register');

    $response = $this->get('/login');
    $response->assertStatus(200)->assertViewIs('auth.login');
    $this->assertGuest();
  }

  /**
   * ログイン状態でユーザー登録ページとログインページにアクセスできないことをテスト.
   *
   * @return void
   */
  public function testFailAccessToLoginAndRegister()
  {
    $user = factory(User::class)->create();
    $this->actingAs($user);
    $response = $this->get('/register');
    $response->assertRedirect('/');

    $response = $this->get('/login');
    $response->assertRedirect('/');
  }

  /**
   *ユーザー登録機能が正常に機能することをテスト.
   *
   * @return void
   */
  public function testRegisterSuccess()
  {
    $this->assertGuest();
    $this->assertDatabaseMissing('users', [
      'name' => 'testuser',
    ]);
    $response = $this->from('/register')->post('/register', [
      'name' => 'testuser',
      'email' => 'test@sample.com',
      'password' => 'test4321',
      'password_confirmation' => 'test4321',
    ]);
    $response->assertRedirect('/');
    $this->assertAuthenticated();
    $this->assertDatabaseHas('users', [
      'name' => 'testuser',
    ]);
  }

  /**
   * ユーザー登録が失敗することをテスト
   *
   * @return void
   */
  public function testRegisterFail()
  {
    $this->assertGuest();
    //全項目を未入力の状態で登録
    $response = $this->from('/register')->post('/register');
    $response->assertRedirect('/register');
    $this->assertFalse(Auth::check());

    //nameを未入力の状態で登録
    $response = $this->from('/register')->post('/register', [
      'name' => '',
      'email' => 'test@sample.com',
      'password' => 'test4321',
      'password_confirmation' => 'test4321',
    ]);
    $response->assertRedirect('/register');
    $this->assertDatabaseMissing('users', ['email' => 'test@sample.com']);
    $this->assertFalse(Auth::check());

    //emailを未入力の状態で登録
    $response = $this->from('/register')->post('/register', [
      'name' => 'test',
      'email' => '',
      'password' => 'test4321',
      'password_confirmation' => 'test4321',
    ]);
    $response->assertRedirect('/register');
    $this->assertDatabaseMissing('users', ['name' => 'test']);
    $this->assertFalse(Auth::check());

    //passwordを未入力の状態で登録
    $response = $this->from('/register')->post('/register', [
      'name' => 'test',
      'email' => 'test@sample.com',
      'password' => '',
      'password_confirmation' => 'test4321',
    ]);
    $response->assertRedirect('/register');
    $this->assertDatabaseMissing('users', ['name' => 'test']);
    $this->assertFalse(Auth::check());

    //password_confirmationを未入力の状態で登録
    $response = $this->from('/register')->post('/register', [
      'name' => 'test',
      'email' => 'test@sample.com',
      'password' => 'test4321',
      'password_confirmation' => '',
    ]);
    $response->assertRedirect('/register');
    $this->assertDatabaseMissing('users', ['name' => 'test']);
    $this->assertFalse(Auth::check());

    //既に登録されているemailと重複するemailで登録
    $user = factory(User::class)->create();
    $response = $this->from('/register')->post('/register', [
      'name' => 'name',
      'email' => $user->email,
      'password' => 'test4321',
      'password_confirmation' => 'test4321',
    ]);
    $response->assertRedirect('/register');
    $this->assertDatabaseMissing('users', ['name' => 'test']);
    $this->assertFalse(Auth::check());

    //emaiの入力値が不正な状態で登録
    $user = factory(User::class)->create();
    $response = $this->from('/register')->post('/register', [
      'name' => 'name',
      'email' => 'unkodesu',
      'password' => 'test4321',
      'password_confirmation' => 'test4321',
    ]);
    $response->assertRedirect('/register');
    $this->assertDatabaseMissing('users', ['name' => 'test']);
    $this->assertFalse(Auth::check());

    //passwordの入力値を8文字未満にして登録
    $response = $this->from('/register')->post('/register', [
      'name' => 'test',
      'email' => 'test@sample.com',
      'password' => 'test432',
      'password_confirmation' => 'test432',
    ]);
    $response->assertRedirect('/register');
    $this->assertDatabaseMissing('users', ['name' => 'test']);
    $this->assertFalse(Auth::check());

    //password_confirmationの値がpasswordと一致しない状態で登録
    $response = $this->from('/register')->post('/register', [
      'name' => 'test',
      'email' => 'test@sample.com',
      'password' => 'test4321',
      'password_confirmation' => 'unkounko',
    ]);
    $response->assertRedirect('/register');
    $this->assertDatabaseMissing('users', ['name' => 'test']);
    $this->assertFalse(Auth::check());
  }

  /**
   * ログイン機能が正常に作動することをテスト
   *
   * @return void
   */
  public function testLoginSuccess()
  {
    $user = factory(User::class)->create();
    $this->assertFalse(Auth::check());
    $response = $this->from('/login')->post('/login', [
      'email' => $user->email,
      'password' => 'test1234',
    ]);
    $this->assertAuthenticatedAs($user);
    $response->assertRedirect('/');
  }

  /**
   * ログインが失敗することをテスト
   *
   * @return void
   */
  public function testLoginFail()
  {
    $user = factory(User::class)->create();
    //emailを未入力の状態でログイン
    $response = $this->from('/login')->post('/login', [
      'email' => '',
      'password' => 'test1234',
    ]);
    $response->assertRedirect('/login');
    $this->assertFalse(Auth::check());

    //passwordが未入力の状態でログイン
    $response = $this->from('/login')->post('/login', [
      'email' => $user->email,
      'password' => '',
    ]);
    $response->assertRedirect('/login');
    $this->assertFalse(Auth::check());

    //emailが登録されているデータと一致しない状態でログイン
    $response = $this->from('/login')->post('/login', [
      'email' => 'unko@sample.com',
      'password' => 'test1234',
    ]);
    $response->assertRedirect('/login');
    $this->assertFalse(Auth::check());

    //passwordが登録されているデータと一致しない状態でログイン
    $response = $this->from('/login')->post('/login', [
      'email' => $user->email,
      'password' => 'unkounko',
    ]);
    $response->assertRedirect('/login');
    $this->assertFalse(Auth::check());
  }
}
