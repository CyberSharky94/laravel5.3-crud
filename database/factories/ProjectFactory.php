<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Project::class, function (Faker\Generator $faker) {

    return [
        'proj_title' => $faker->name,
        'proj_start_date' => $faker->dateTime(),
        'proj_end_date' => $faker->dateTime(),
        'user_id' => '1',
    ];
});
