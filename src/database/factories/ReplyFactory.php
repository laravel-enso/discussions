<?php

use Faker\Generator as Faker;
use LaravelEnso\Discussions\app\Models\Discussion;
use LaravelEnso\Discussions\app\Models\Reply;

$factory->define(Reply::class, fn (Faker $faker) => [
    'discussion_id' => fn () => factory(Discussion::class)->create()->id,
    'body' => $faker->sentence,
]);
