<?php

namespace App\Http\Requests;


class ServiceSelectRequest extends DigitalRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'service' => 'required'
        ];
    }

    /**
     * @inheritdoc
     */
    public function messages()
    {
        return [
            'service.required' => 'Select a service'
        ];
    }
}
