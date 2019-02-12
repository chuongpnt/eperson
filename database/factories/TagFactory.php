<?php

$factory->define(App\Engine\Models\Tag::class, function (Faker\Generator $faker) {
    return [
        "name" => $faker->name,
        "recommend" => 1,
        "hot" => 0,
        "new" => 1,
    ];
});
