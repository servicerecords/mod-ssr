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
     * @var null|string
     */
    private $message = null;

    /**
     * Create a new rule instance.
     *
     * @param null|string $month
     * @param null|string $year
     * @param null|string $message
     */
    public function __construct($month = null, $year = null, string $message = null)
    {
        if ($month < 1 || $month > 12) $month = null;

        $this->maxDays = cal_days_in_month(CAL_GREGORIAN, $month ?? 1, $year ?? 2000);
        $this->message = $message;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
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
        return $this->message ?? 'Enter a valid day';
    }
}
