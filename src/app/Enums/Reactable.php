<?php

namespace LaravelEnso\Discussions\app\Enums;

use LaravelEnso\Helpers\app\Classes\Enum;
use LaravelEnso\Discussions\app\Models\Reply;
use LaravelEnso\Discussions\app\Models\Discussion;

class Reactable extends Enum
{
    protected static $data = [
        'discussion' => Discussion::class,
        'reply' => Reply::class,
    ];
}
