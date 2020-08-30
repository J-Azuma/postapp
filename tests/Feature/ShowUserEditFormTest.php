<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

/**
 * ユーザー編集ページに関するテスト.
 */
class UserTest extends TestCase
{
  use RefreshDatabase;
  /**
   * ユーザー編集ページへのアクセスをテスト.
   *
   * @return void
   */
  public function testShowEditUserFormSuccess()
  {
    $user = factory(User::class)->create();
    $response = $this->actingAs($user)->get('/users/edit/'.$user->id);
    $response->assertOk();
  }

  /**
   * 自分以外のユーザー編集ページにアクセスすると403ステータスがレスポンスされることをテスト
   *
   * @return void
   */
  public function testShowEditUserFormForbidden()
  {
    $user = factory(User::class)->create();
    $user2 = factory(User::class)->create();

    $response = $this->actingAs($user)->get('/users/edit/'.$user2->id);
    $response->assertStatus(403);
  }

  /**
   * 存在しないユーザーのユーザー編集ページにアクセスすると404ステータスがレスポンスされることをテスト.
   *
   * @return void
   */
  public function testShowEditUserFormNotFound()
  {
    $user = factory(User::class)->create();
    $response = $this->actingAs($user)->get('/users/edit/50000000000');
    $response->assertStatus(404);
  }


}
