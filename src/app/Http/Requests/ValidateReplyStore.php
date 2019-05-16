<?php

namespace LaravelEnso\Discussions\app\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidateReplyStore extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'discussion_id' => $this->discussionId(),
            'body' => 'required',
        ];
    }

    protected function discussionId()
    {
        return 'required|exists:discussions,id';
    }
}
