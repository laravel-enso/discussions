<?php

namespace LaravelEnso\Discussions\Http\Requests;

class ValidateDiscussionStore extends ValidateDiscussionFetch
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => 'required',
            'body' => 'required',
        ] + parent::rules();
    }
}
