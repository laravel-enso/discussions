<?php

namespace LaravelEnso\Discussions\app\Http\Requests;

class ValidateReplyUpdate extends ValidateReplyStore
{
    protected function discussionId()
    {
        return 'nullable';
    }
}
