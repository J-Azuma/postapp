<?php

namespace Tests\Feature;

use App\Post;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

/**
 * 認証機能に関するテスト.
 */
class AuthHttpTest extends TestCase
{
  use RefreshDatabase;


  /**
   * A basic feature test example.
   *
   * @return void
   */
  public function testAuthAccess()
  {
    $response = $this->get('/register');
    $response->assertStatus(200)->assertViewIs('auth.register');

    $response = $this->get('/login');
    $response->assertStatus(200)->assertViewIs('auth.login');
  }
}
