<?php

use LaravelEnso\Core\app\Models\UserGroup;

return [
    'onDelete' => 'restrict',
    'loggableMorph' => [
        'discussable' => [
            UserGroup::class => 'name',
        ],
    ],
];
