<?php

namespace LaravelEnso\Discussions\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidateDiscussionUpdate extends FormRequest
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
        ];
    }
}
