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
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
        'type' => 0,
        'provider' => null,
    ];
});

$factory->define(App\Post::class, function (Faker\Generator $faker) {
    return [
        // 'title' => $faker->realText($maxNbChars = 10),
        'title' => $faker->sentence(),
        'content' => $faker->realText($maxNbChars = 200),
        // 'user_id' => 0,
        'created_at' => $faker->dateTimeBetween('-1 month', '+3 days'),
        // 'type' => $faker->numberBetween(1, 3),
        // 'user_id' => function () {
        //     return factory(App\User::class)->create()->id;
        // },
    ];
});

$factory->define(App\PostType::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->word(),
    ];
});

$factory->define(App\Comment::class, function (Faker\Generator $faker) {
    return [
        'content' => $faker->sentence(),
        'created_at' => $faker->dateTimeBetween('-1 month', '+3 days'),
    ];
});