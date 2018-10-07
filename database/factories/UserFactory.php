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

$factory->define(App\User::class, function (Faker $faker) {
    
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => bcrypt('1111'),
        'remember_token' => str_random(10),
        'sns_id'=> $faker->userName,
        'sns_type'=> $faker->domainName,
        'sns_name'=> $faker->name,
        'sns_email'=> $faker->unique()->safeEmail,
        'created_at' => $faker->dateTime,
    ];
});

$factory->define(App\Article::class, function (Faker $faker) {
    return [
        'user_id' => \App\User::inRandomOrder()->first(),
        'title' => $faker->sentence,
        'article' => $faker->sentence,
        'views' => $faker->randomDigit,
        'likes' => $faker->randomDigit,
        'created_at' => $faker->dateTime,
    ];  
});

$factory->define(App\Comment::class, function (Faker $faker) {
    return [
        'user_id' => \App\User::inRandomOrder()->first(),
        'article_id' => \App\Article::inRandomOrder()->first(),
        'article' => $faker->sentence,
        'created_at' => $faker->dateTime,
    ];
});
