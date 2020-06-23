<?php

namespace LaravelEnso\Discussions\Http\Requests;

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
            'discussion_id' => $this->discussionId(),
            'body' => 'required',
        ];
    }

    protected function discussionId()
    {
        return $this->route('reply')
            ? 'nullable'
            : 'required|exists:discussions,id';
    }
}
