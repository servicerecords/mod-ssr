<?php

namespace App\Http\Requests;


class ApplicantNextOfKinRequest extends DigitalRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'applicant-next-of-kin' => 'required',
        ];
    }

    /**
     * @inheritdoc
     */
    public function messages()
    {
        return [
            'applicant-next-of-kin.required' => 'Tell us if you are the immediate next of kin',
        ];
    }
}
