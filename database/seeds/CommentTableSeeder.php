<?php

use Illuminate\Database\Seeder;

class CommentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('comments')->truncate();
        for ($i = 1; $i < 5; $i++) {
            for ($int = 1; $int < 5; $int++) {
                DB::table('comments')->insert([
                    'user_id' => $i,
                    'question_id' => $int,
                    'comment' => 'test_title'.$int
                ]);
            }
        }
    }
}
