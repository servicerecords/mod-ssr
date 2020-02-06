<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EssentialInformationSave extends FormRequest
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
            'firstnames' => 'required',
			'lastname' => 'required',
			'dob_day' => 'digits_between:1,2|nullable',
			'dob_month' => 'digits_between:1,2|nullable',
			'dob_year' => 'digits:4|nullable',
        ];
    }

    /**
	 * Get the validation messages that apply to the rules
	 *
	 * @return array
	 */
    public function messages()
	{
		return [
			'firstnames.required' => 'Please enter any first names',
			'lastname.required' => 'Please enter a last name',
            //'birth_place.required' => 'Please enter a place of birth',
			'dob_month.digits_between' => 'The date of birth\'s month must be no more than 2 characters in length',
			'dob_day.digits_between' => 'The date of birth\'s day must be no more than 2 characters in length',
			'dob_month.max' => 'The date of birth\'s month must be no more than 2 characters in length',
			'dob_year.digits' => 'The date of birth\'s year must be 4 characters in length',
			//'dob_year.required' => 'Please enter a year of birth, even if it is an estimate',
			//'dob_accurate.required' => 'Please specify whether the date of birth is accurate'
		];
	}
}
