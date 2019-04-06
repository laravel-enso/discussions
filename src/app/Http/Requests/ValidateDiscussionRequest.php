<?php

namespace LaravelEnso\Discussions\app\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use LaravelEnso\Discussions\app\Exceptions\DiscussionException;

class ValidateDiscussionRequest extends FormRequest
{
    public function authorize()
    {
        $this->checkParams();

        return true;
    }

    public function rules()
    {
        $morphRules = [
            'discussable_id' => 'required',
            'discussable_type' => 'required',
        ];

        if ($this->method() === 'GET') {
            return $morphRules;
        }

        $rules = [
            'title' => 'required',
            'body' => 'required',
        ];

        return $this->method() === 'POST'
            ? $rules + $morphRules
            : $rules;
    }

    public function checkParams()
    {
        if ($this->method() !== 'PATCH' && ! class_exists($this->discussable_type)) {
            throw new DiscussionException(
                'The "discussable_type" property must be a valid model class'
            );
        }
    }
}
