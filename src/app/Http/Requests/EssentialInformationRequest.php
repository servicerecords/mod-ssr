<?php

namespace App\Http\Requests;

use App\Rules\Day;
use App\Rules\Month;
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
            'serviceperson-date-of-birth-date-day' => [
                new Day(
                    request()->input('serviceperson-date-of-birth-date-month'),
                    request()->input('serviceperson-date-of-birth-date-year')
                ),
                'nullable'
            ],
            'serviceperson-date-of-birth-date-month' => [
                new Month(),
                'nullable'
            ],
           'serviceperson-date-of-birth-date-year' => 'required|digits:4|integer|validate_dob|max:' . date('Y'),
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
            'serviceperson-date-of-birth-date-year.digits' => 'The date of birth\'s year must be 4 characters in length',
            'serviceperson-date-of-birth-date-year.required' => 'Enter a year of birth, even if it is an estimate',
            'serviceperson-date-of-birth-date-year.max' => 'Enter a date of birth (even if partial) that is in the past',
            'serviceperson-date-of-birth-date-year.validate_dob' => 'Enter a valid date of birth'
        ];
    }
}
