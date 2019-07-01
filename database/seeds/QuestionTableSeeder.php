<?php

use Illuminate\Database\Seeder;

class QuestionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('questions')->truncate();
        DB::table('questions')->insert([
            [
                'user_id'         => 4,
                'tag_category_id' => 1,
                'title'           => 'test_title1',
                'content'         => 'test_content1'
            ],
            [
                'user_id'         => 4,
                'tag_category_id' => 2,
                'title'           => 'test_title2',
                'content'         => 'test_content2'
            ],
            [
                'user_id'         => 4,
                'tag_category_id' => 3,
                'title'           => 'test_title3',
                'content'         => 'test_content3'
            ],
            [
                'user_id'         => 4,
                'tag_category_id' => 4,
                'title'           => 'test_title4',
                'content'         => 'test_content4'
            ],
        ]);
    }
}
