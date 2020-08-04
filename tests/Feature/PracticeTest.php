<?php

namespace Tests\Feature;

use App\Post;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PracticeTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
      $user = factory(User::class)->create();

        $response = $this->get('/');
        $response->assertStatus(200);

        $response = $this->get('/posts/index');
        $response->assertStatus(200);

        $response = $this->get('/posts/detail/11111111');
        $response->assertStatus(404);

        $response = $this->get('/posts/detail/60');
        $response->assertStatus(200);

        //どのユーザーとしてアクセスするのか明記する必要がある。
        //$response = $this->get('/users/detail/3');
        //$response->assertStatus(200);

        $response = $this->get('/users/detail/30000000');
        $response->assertStatus(404);
    }
}
