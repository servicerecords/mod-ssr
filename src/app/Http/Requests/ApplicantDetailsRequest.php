<?php

namespace App\Http\Requests;


class ApplicantDetailsRequest extends DigitalRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'applicant-name' => 'required',
            'applicant-email-address' => 'required|email',
            'applicant-address-line-1' => 'required',
            'applicant-address-postcode' => 'required',
            'applicant-address-country' => 'required',
            'applicant-telephone' => 'required',
            'applicant-details-transfer' => 'required',
        ];
    }

    /**
     * @inheritdoc
     */
    public function messages()
    {
        return [
            'applicant-name.required' => 'Enter your full name',
            'applicant-email-address.required' => 'Enter your email address',
            'applicant-email-address.email' => 'Make sure you have entered a valid email address',
            'applicant-address-line-1.required' => 'Enter your house name/number and street address',
            'applicant-address-postcode.required' => 'Enter the postcode of your address',
            'applicant-address-country.required' => 'Enter a country for your address',
            'applicant-telephone.required' => 'Enter your telephone number, including country code',
            'applicant-details-transfer.required' => 'Select whether to use this information for billing',
        ];
    }
}
