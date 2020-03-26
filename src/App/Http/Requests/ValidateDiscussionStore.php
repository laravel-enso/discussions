<?php

namespace LaravelEnso\Discussions\App\Http\Requests;

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
