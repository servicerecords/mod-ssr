<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class Day implements Rule
{
    /**
     * @var int
     */
    private $maxDays = 31;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($month = null, $year = null)
    {
        if($month < 1 || $month > 12) $month = null;

        $this->maxDays = cal_days_in_month(CAL_GREGORIAN, $month ?? 1, $year ?? 2000);
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return $value >= 1 && $value <= $this->maxDays;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Enter a valid day';
    }
}
