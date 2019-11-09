<?php

namespace LaravelEnso\Discussions\app\Enums;

use LaravelEnso\Discussions\app\Models\Discussion;
use LaravelEnso\Discussions\app\Models\Reply;
use LaravelEnso\Enums\app\Services\Enum;

class Reactable extends Enum
{
    protected static $data = [
        'discussion' => Discussion::class,
        'reply' => Reply::class,
    ];
}
