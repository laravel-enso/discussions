<?php

namespace LaravelEnso\Discussions\App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidateDiscussionFetch extends FormRequest
{
    public function rules()
    {
        return [
            'discussable_id' => 'required',
            'discussable_type' => 'required',
        ];
    }
}
