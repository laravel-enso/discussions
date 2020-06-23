<?php

namespace LaravelEnso\Discussions\Enums;

use LaravelEnso\Discussions\Models\Discussion;
use LaravelEnso\Discussions\Models\Reply;
use LaravelEnso\Enums\Services\Enum;

class Reactable extends Enum
{
    protected static array $data = [
        'discussion' => Discussion::class,
        'reply' => Reply::class,
    ];
}
