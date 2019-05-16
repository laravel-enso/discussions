<?php

namespace LaravelEnso\Discussions\app\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidateReplyUpdate extends ValidateReplyStore
{
    protected function discussionId()
    {
        return 'nullable';
    }
}
