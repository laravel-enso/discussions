<?php

namespace LaravelEnso\Discussions\app\Http\Requests;

class ValidateDiscussionFetch extends ValidateDiscussionStore
{
    public function rules()
    {
        return [
            'discussable_id' => 'required',
            'discussable_type' => 'required',
        ];
    }
}
