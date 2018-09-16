<?php

namespace LaravelEnso\Discussions\app\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidateDiscussionRequest extends FormRequest
{
    private const DiscussableRules = [
        'discussable_id' => 'required',
            'discussable_type' => 'required',
    ];

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        if ($this->method() === 'GET') {
            return self::DiscussableRules;
        }

        $rules = [
            'title' => 'required',
            'body' => 'required',
        ];

        if ($this->method() === 'POST') {
            $rules = $rules + self::DiscussableRules;
        }

        return $rules;
    }
}
