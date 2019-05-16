<?php

namespace LaravelEnso\Discussions\app\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use LaravelEnso\Discussions\app\Exceptions\DiscussionException;

class ValidateDiscussionStore extends FormRequest
{
    public function authorize()
    {
        $this->checkParams();

        return true;
    }

    public function rules()
    {
        return [
            'discussable_id' => 'required',
            'discussable_type' => 'required',
            'title' => 'required',
            'body' => 'required',
        ];
    }

    public function checkParams()
    {
        if (! class_exists($this->discussable_type)) {
            throw new DiscussionException(
                'The "discussable_type" property must be a valid model class'
            );
        }
    }
}
