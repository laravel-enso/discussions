<?php

namespace LaravelEnso\Discussions\app\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidateReplyRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'discussion_id' => $this->method() === 'POST'
                ? 'required|exists:discussions,id'
                : 'nullable',
            'body' => 'required',
        ];
    }
}
