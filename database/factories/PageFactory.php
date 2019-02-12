<?php

$factory->define(App\Page::class, function (Faker\Generator $faker) {
    return [
        "title" => $faker->name,
        "title_jp" => $faker->name,
        "description" => $faker->name,
        "description_jp" => $faker->name,
        "content" => $faker->name,
        "content_jp" => $faker->name,
        "slug" => $faker->name,
        "stage" => $faker->name,
        "keyword" => $faker->name,
    ];
});
