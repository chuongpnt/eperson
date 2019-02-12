<?php

$factory->define(App\Engine\Models\FaqQuestion::class, function (Faker\Generator $faker) {
    return [
        "category_id" => factory('App\Engine\Models\FaqCategory')->create(),
        "question_text" => $faker->name,
        "answer_text" => $faker->name,
    ];
});
