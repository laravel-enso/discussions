<?php

namespace LaravelEnso\Discussions\app\Classes;

use LaravelEnso\Discussions\app\Exceptions\DiscussionConfigException;

class ConfigMapper
{
    private $type;

    public function __construct(string $type)
    {
        $this->type = $type;
    }

    public function class()
    {
        $discussable = config('enso.discussions.discussables.'.$this->type);

        if (is_null($discussable)) {
            throw new DiscussionConfigException(__(
                'Entity ":entity" does not exist in enso/discussions.php config file',
                ['entity' => $this->type]
            ));
        }

        return $discussable;
    }
}
