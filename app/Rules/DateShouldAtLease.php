<?php

namespace App\Rules;

use Carbon\Carbon;
use Illuminate\Contracts\Validation\Rule;

class DateShouldAtLease implements Rule
{

    public $days;
    public $errorMessage;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($days, $errorMessage)
    {
        $this->days = $days;
        $this->errorMessage = $errorMessage;
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
        $enteredDate = Carbon::parse($value);
        return $enteredDate->diffInDays(now()) >= $this->days;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return $this->errorMessage;
    }
}
