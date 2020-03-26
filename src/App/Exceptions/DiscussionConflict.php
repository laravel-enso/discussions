<?php

namespace LaravelEnso\Discussions\App\Exceptions;

use Symfony\Component\HttpKernel\Exception\ConflictHttpException;

class DiscussionConflict extends ConflictHttpException
{
    public static function delete()
    {
        return new static(__('The entity has discussions and cannot be deleted'));
    }

    public static function hasReplies()
    {
        return new static(__('The discussion has replies and cannot be deleted'));
    }
}
