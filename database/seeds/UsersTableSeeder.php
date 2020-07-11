<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      //テスト用ユーザー1
        DB::table('users')->insert([
          'name' => 'test',
          'email' => 'test@sample.com',
          'password' => bcrypt('testtest'),
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now(),
        ]);

        //テスト用ユーザー2(自分の投稿にコメントをつけられない仕様。ユーザー１の投稿にコメントをつけるために作成)
        DB::table('users')->insert([
          'name' => 'test2',
          'email' => 'test2@sample.com',
          'password' => bcrypt('test2test2'),
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now(),
        ]);
    }
}
