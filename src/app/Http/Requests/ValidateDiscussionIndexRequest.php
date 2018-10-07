<?php

namespace LaravelEnso\Discussions\app\Http\Requests;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Http\FormRequest;
use LaravelEnso\Discussions\app\Exceptions\DiscussionException;

class ValidateDiscussionIndexRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'discussable_id' => 'required',
            'discussable_type' => 'required',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if (!class_exists($this->discussable_type)
                || !new $this->discussable_type instanceof Model) {
                throw new DiscussionException(
                    'The "discussable_type" property must be a valid model class'
                );
            }
        });
    }
}
