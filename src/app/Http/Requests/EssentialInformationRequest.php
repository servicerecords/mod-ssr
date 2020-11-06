<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Validation\Factory as ValidationFactory;

class EssentialInformationRequest extends DigitalRequest
{
    public function __construct(ValidationFactory $validationFactory)
    {

        $validationFactory->extend(
            'validate_dob',
            function ($attribute, $value, $parameters) {
                $dayKey = 'serviceperson-date-of-birth-day';
                $monthKey = 'serviceperson-date-of-birth-month';
                $yearKey = 'serviceperson-date-of-birth-year';

                if ((null !== request()->input($dayKey) && null !== request()->input($monthKey)) && null !== request()->input($yearKey)) {
                    $input = sprintf("%02d", request()->input($dayKey)) . '/' . sprintf("%02d", request()->input($monthKey)) . '/' . request()->input($yearKey);

                    try {
                        $d = \DateTime::createFromFormat('d/m/Y', $input);
                        $date = $d && $d->format('d/m/Y') === $input;

                        if ($date === false) {
                            return false;
                        }
                        Carbon::parse($d)->isPast();
                        return true;
                    } catch (\Exception $e) {
                        dd(request()->input($dayKey), request()->input($monthKey), request()->input($yearKey), $e);
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
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'serviceperson-first-name' => 'required',
            'serviceperson-last-name' => 'required',
            'serviceperson-date-of-birth-day' => 'digits_between:1,31|nullable',
            'serviceperson-date-of-birth-month' => 'digits_between:1,12|nullable',
            'serviceperson-date-of-birth-year' => 'required|digits:4|integer|validate_dob|max:' . date('Y'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function messages()
    {
        return [
            'serviceperson-first-name.required' => 'Enter any first names',
            'serviceperson-last-name.required' => 'Enter a last name',
            'serviceperson-date-of-birth-month.digits_between' => 'The date of birth\'s month must be no more than 2 characters in length',
            'serviceperson-date-of-birth-month.between' => 'Enter a valid month',
            'serviceperson-date-of-birth-day.between' => 'Enter a valid day',
            'serviceperson-date-of-birth-day.digits_between' => 'The date of birth\'s day must be no more than 2 characters in length',
            'serviceperson-date-of-birth-month.max' => 'The date of birth\'s month must be no more than 2 characters in length',
            'serviceperson-date-of-birth-year.digits' => 'The date of birth\'s year must be 4 characters in length',
            'serviceperson-date-of-birth-year.required' => 'Enter a year of birth, even if it is an estimate',
            'serviceperson-date-of-birth-year.max' => 'Enter a date of birth (even if partial) that is in the past',
            'serviceperson-date-of-birth-year.validate_dob' => 'Enter a valid date of birth'
        ];
    }
}
