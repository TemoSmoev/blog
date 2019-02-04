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
    ];
});

$factory->define(App\Post::class, function (Faker\Generator $faker) {
    static $password;
    $images=['blog-1.jpg','blog-2.jpg','blog-3.jpg','blog-grid.jpg','ins-2.jpg','ins-3.jpg','ins-4.jpg','p1.jpg','p2.jpg'];

    return [
        'title' => $faker->sentence,
        'content' => $faker->sentence  ,
        'image' => $images[rand(0,sizeof($images)-1)],
        'date'=>'08/08/17',
        'views'=>$faker->numberBetween(0,5000),
        'category_id'=>1,
        'user_id'=>1,
        'status'=>1,
        'is_featured'=>0
    ];
});

$factory->define(App\Category::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'title' => $faker->word,
        
    ];
});


$factory->define(App\Tag::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'title' => $faker->word,
        
    ];
});

