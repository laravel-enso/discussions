<?php

namespace LaravelEnso\Discussions\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use LaravelEnso\Discussions\Models\Discussion;
use LaravelEnso\Discussions\Models\Reply;

class ReplyFactory extends Factory
{
    protected $model = Reply::class;

    public function definition()
    {
        return [
            'discussion_id' => Discussion::factory(),
            'body' => $this->faker->sentence,
        ];
    }
}
