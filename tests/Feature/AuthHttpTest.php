<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthHttpTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testAuthAccess()
    {
      //そもそもこれだけではユーザーが用意されない
      $user = factory(User::class)->create();

      $response = $this->post('posts/create',
      ['title' => 'fizzbuzz', 'content' => 'foobar',]);
      $response->assertStatus(302);
    }
}
