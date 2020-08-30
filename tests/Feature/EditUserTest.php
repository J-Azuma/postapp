<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

/**
 * ユーザー情報編集に関するテスト.
 */
class EditUserTest extends TestCase
{
  /**
   * ユーザー編集が成功することをテスト
   *
   * @return void
   */
  public function testEditUserSuccess()
  {
    $user = factory(User::class)->create();
    $response = $this->actingAs($user)->from('/users/edit/' . $user->id)->post('/users/edit/' . $user->id, [
      'name' => 'ピョートル1世',
      'email' => 'russian@sample.com',
      'profile' => str_repeat('s', 200),
    ]);
    $response->assertRedirect('/users/detail/' . $user->id);
    $this->assertDatabaseHas('users', [
      'name' => 'ピョートル1世',
      'email' => 'russian@sample.com',
      'profile' => str_repeat('s', 200),
    ]);
  }

  /**
   * 全ての入力欄が空欄の時に ユーザー編集が失敗するテスト
   *
   * @return void
   */
  public function testEditUserFail()
  {
    $user = factory(User::class)->create();
    $response = $this->actingAs($user)->from('/users/edit/' . $user->id)->post('/users/edit/' . $user->id, [
      'name' => '',
      'email' => '',
      'profile' => '',
    ]);
    $response->assertRedirect('/users/edit/'.$user->id);
    $this->assertDatabaseHas('users',[
      'name' => $user->name,
      'email' => $user->email,
      'profile' => $user->profile,
    ]);
  }
}
