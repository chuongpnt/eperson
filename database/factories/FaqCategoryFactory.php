<?php

$factory->define(App\Engine\Models\FaqCategory::class, function (Faker\Generator $faker) {
    return [
        "title" => $faker->name,
    ];
});
