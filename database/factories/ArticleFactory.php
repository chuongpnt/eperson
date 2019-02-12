<?php

$factory->define(App\Engine\Models\Article::class, function (Faker\Generator $faker) {
    return [
        "title" => $faker->name,
        "summary" => $faker->name,
        "content" => $faker->name,
        "stage" => collect(["Available","Not Available","Blocked",])->random(),
        "category_id" => factory('App\Engine\Models\Category')->create(),
        "user_id" => factory('App\Engine\Models\User')->create(),
    ];
});
