<?php

namespace App\Http\Requests;


class FeedbackRequest extends DigitalRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'feedback-satisfaction' => 'required',
        ];
    }

    /**
     * @inheritdoc
     */
    public function messages()
    {
        return [
            'feedback-satisfaction.required' => 'Tell us how satisfied you were with the service.'
        ];
    }
}
