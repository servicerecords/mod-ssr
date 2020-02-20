<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class YourInformationSave extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'fullname' => 'required',
            'email' => 'required|email',
			'address_line_1' => 'required',
			'address_postcode' => 'required',
            'use_billing' => 'required',
            'telephone' => 'required_unless:country,GB'
        ];
    }

    public function messages()
	{
		return [
			'fullname.required' => 'Enter your fullname',
            'email.required' => 'Enter your email address',
            'email.email' => 'Please make sure you have entered a valid email address',
			'address_line_1.required' => 'Enter your house name/number and street address',
			'address_postcode.required' => 'Enter the postcode of your address',
            'use_billing.required' => 'Please select whether to use this information for billing',
            'telephone.required_unless' => 'Please enter your telephone number, including country code'
		];
	}
}
