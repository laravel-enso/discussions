<?php

use Faker\Generator as Faker;
use LaravelEnso\Discussions\app\Models\Discussion;

$factory->define(Discussion::class, function (Faker $faker) {
    return [
        'discussable_id' => $faker->randomDigit,
        'discussable_type' => $faker->word,
        'body' => $faker->sentence,
        'title' => $faker->sentence,
    ];
});
