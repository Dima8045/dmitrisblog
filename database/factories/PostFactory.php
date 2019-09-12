<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'title' => $faker->title,
        'content' => $faker->realText(700),
        'image' => $faker->imageUrl(800, 600, 'cats', true, 'Faker', true),
        'published' => $faker->boolean,
        'category_id' => random_int(1,3),
        'user_id' => random_int(1,5),
    ];
});
