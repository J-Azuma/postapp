<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $user = DB::table('users')->where('name', 'test2')->first();
      foreach (range(1,10) as $num) {
        DB::table('comments')->insert([
          'post_id' => App\Post::first()->id,
          'content' => "dummy: comment {$num} \n unko unko",
          'user_id' => $user->id,
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now(),
        ]);
      }
    }
}
