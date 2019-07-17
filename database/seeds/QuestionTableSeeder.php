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
        for ($i = 1; $i < 5; $i++) {
            for ($int = 1; $int < 5; $int++) {
                DB::table('questions')->insert([
                    'user_id' => $i,
                    'tag_category_id' => $int,
                    'title' => 'test_title'.$int,
                    'content' => 'test_content'.$int
                ]);
            }
        }
    }
}
