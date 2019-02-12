<?php

$factory->define(App\Engine\Models\Post::class, function (Faker\Generator $faker) {
    return [
        "title" => $faker->name,
        "summary" => $faker->name,
        "content" => $faker->name,
        "rating" => $faker->randomNumber(2),
        "viewer" => $faker->randomNumber(2),
        "stage" => collect(["Available","Not Available","Blocked",])->random(),
        "category_id" => factory('App\Engine\Models\Category')->create(),
        "user_id" => factory('App\Engine\Models\User')->create(),
    ];
});
