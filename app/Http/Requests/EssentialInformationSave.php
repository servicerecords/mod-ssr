<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Factory as ValidationFactory;
use Carbon\Carbon;

class EssentialInformationSave extends FormRequest
{

    public function __construct(ValidationFactory $validationFactory)
    {

        $validationFactory->extend(
            'validate_dob',
            function ($attribute, $value, $parameters) {
                //dd(request()->input('dob_day'), request()->input('dob_month'), request()->input('dob_year'));
                if((null !== request()->input('dob_day') && null !== request()->input('dob_month')) && null !== request()->input('dob_year')) {
                    //dd(request()->input('dob_day'), request()->input('dob_month'), request()->input('dob_year'));
                    $input  = request()->input('dob_day') . '/' . sprintf("%02d", request()->input('dob_month')) . '/' . request()->input('dob_year');

                    try{
                        $d = \DateTime::createFromFormat('d/m/Y', $input);
                        // The Y ( 4 digits year ) returns TRUE for any integer with any number of digits so changing the comparison from == to === fixes the issue.
                        $date = $d && $d->format('d/m/Y') === $input;
                        if($date === false) {
                            return false;
                        }
                        Carbon::parse($d)->isPast();
                        return true;
                    } catch(\Exception $e) {
                        dd(request()->input('dob_day'), request()->input('dob_month'), request()->input('dob_year'), $e);
                        return false;
                    }
                } else {
                    return true;
                }
            },
            (isset($message) ? $message : '')
        );

    }

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
			'dob_day' => 'digits_between:1,31|nullable',
			'dob_month' => 'digits_between:1,12|nullable',
			'dob_year' => 'digits:4|required|integer|validate_dob|max:'.date('Y'),
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
            'dob_month.between' => 'Please enter a valid month',
            'dob_day.between' => 'Please enter a valid day',
			'dob_day.digits_between' => 'The date of birth\'s day must be no more than 2 characters in length',
			'dob_month.max' => 'The date of birth\'s month must be no more than 2 characters in length',
			'dob_year.digits' => 'The date of birth\'s year must be 4 characters in length',
			'dob_year.required' => 'Please enter a year of birth, even if it is an estimate',
			'dob_year.max' => 'Please enter a dob (even if partial) that is in the past',
            'dob_year.validate_dob' => 'Please enter a valid date of birth'
		];
	}

    /**
     * Configure the validator instance.
     *
     * @param  \Illuminate\Validation\Validator  $validator
     * @return void
     */
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            request()->session()->put('essential_information', request()->all());
        });
    }
}
