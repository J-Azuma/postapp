<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $user = DB::table('users')->first();
        foreach (range(1,20) as $num) {
          DB::table('posts')->insert([
            'title' => "title {$num}",
            'content' => "dummy: {$num} \n test test test test test test unko nyaan",
            'user_id' => $user->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
          ]);
        }
    }
}
