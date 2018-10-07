<?php

namespace LaravelEnso\Discussions\app\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidateDiscussionRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'title' => 'required',
            'body' => 'required',
        ];

        if ($this->method() === 'POST') {
            $rules = $rules + [
                'discussable_id' => 'required',
                'discussable_type' => 'required',
            ];
        }

        return $rules;
    }
}
