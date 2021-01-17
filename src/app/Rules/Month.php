<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class Month implements Rule
{
    private $message = null;

    /**
     * Create a new rule instance.
     *
     * @param null|string $message
     */
    public function __construct(string $message = null)
    {
        $this->message = $message;
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
        return $value >= 1 && $value <= 12;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return $this->message ?? 'Enter a valid month';
    }
}
