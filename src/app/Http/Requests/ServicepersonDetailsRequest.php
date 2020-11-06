<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Validation\Factory as ValidationFactory;

class ServicepersonDetailsRequest extends DigitalRequest
{
    public function __construct(ValidationFactory $validationFactory)
    {

        $validationFactory->extend(
            'validate_dob',
            function ($attribute, $value, $parameters) {
                if ((null !== request()->input('date-of-birth-day') && null !== request()->input('date-of-birth-month')) && null !== request()->input('date-of-birth-year')) {
                    $input = request()->input('date-of-birth-day') . '/' . sprintf("%02d", request()->input('date-of-birth-month')) . '/' . request()->input('date-of-birth-year');

                    try {
                        $d = \DateTime::createFromFormat('d/m/Y', $input);
                        $date = $d && $d->format('d/m/Y') === $input;
                        if ($date === false) {
                            return false;
                        }
                        Carbon::parse($d)->isPast();
                        return true;
                    } catch (\Exception $e) {
                        dd(request()->input('date-of-birth-day'), request()->input('date-of-birth-month'), request()->input('date-of-birth-year'), $e);
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
        ];
    }

    /**
     * @inheritdoc
     */
    public function messages()
    {
        return [
        ];
    }
}
