<?php

$factory->define(App\Engine\Models\Role::class, function (Faker\Generator $faker) {
    return [
        "title" => $faker->name,
    ];
});
