<?php

use Illuminate\Database\Seeder;

class DailyReportsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('daily_reports')->truncate();
        DB::table('daily_reports')->insert([
            [
                'user_id'        => 4,
                'title'          => 'test1',
                'content'        => 'teet_content',
                'reporting_time' => Carbon::create(2019, 5, 3),
                'created_at'     => Carbon::create(2019, 5, 3),
                'updated_at'     => Carbon::create(2019, 5, 3),
            ],
            [
                'user_id'        => 4,
                'title'          => 'test2',
                'content'        => 'test_content',
                'reporting_time' => Carbon::create(2019, 6, 3),
                'created_at'     => Carbon::create(2019, 6, 3),
                'updated_at'     => Carbon::create(2019, 6, 3),
            ],
            [
                'user_id'        => 4,
                'title'          => 'test3',
                'content'        => 'test_content',
                'reporting_time' => Carbon::create(2019, 6, 4),
                'created_at'     => Carbon::create(2019, 6, 4),
                'updated_at'     => Carbon::create(2019, 6, 4),
            ],
        ]);
    }
}
