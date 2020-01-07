<?php

namespace LaravelEnso\Discussions\App\Enums;

use LaravelEnso\Discussions\App\Models\Discussion;
use LaravelEnso\Discussions\App\Models\Reply;
use LaravelEnso\Enums\App\Services\Enum;

class Reactable extends Enum
{
    protected static array $data = [
        'discussion' => Discussion::class,
        'reply' => Reply::class,
    ];
}
