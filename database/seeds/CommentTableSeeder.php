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
        DB::table('comments')->insert([
            [
                'user_id'     => 4,
                'question_id' => 1,
                'comment'     => 'test_comment1'
            ],
            [
                'user_id'     => 4,
                'question_id' => 2,
                'comment'     => 'test_comment2'
            ],
            [
                'user_id'     => 4,
                'question_id' => 3,
                'comment'     => 'test_comment3'
            ],
            [
                'user_id'     => 4,
                'question_id' => 4,
                'comment'     => 'test_comment4'
            ],
        ]);
    }
}
