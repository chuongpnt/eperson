<?php

$factory->define(App\Engine\Models\Category::class, function (Faker\Generator $faker) {
    return [
        "title" => $faker->name,
        "summary" => $faker->name,
        "is_enable" => 1,
        "parent_id" => factory('App\Engine\Models\Category')->create(),
    ];
});
