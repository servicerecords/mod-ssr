<?php

namespace App\Http\Requests;

class DeathInServiceRequest extends DigitalRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'serviceperson-died-in-service' => 'required'
        ];
    }

    /**
     * @inheritdoc
     */
    public function messages()
    {
        return [
            'serviceperson-died-in-service.required' => 'State if they died in service'
        ];
    }
}
