<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\Models\Question::class, function (Faker $faker) {
    return [
        'user_id' => $faker->biasedNumberBetween($min = 1, $max = 4),
        'tag_category_id' => $faker->biasedNumberBetween($min = 1, $max = 4),
        'title' => $faker->word,
        'content' => $faker->sentence,
    ];
});
