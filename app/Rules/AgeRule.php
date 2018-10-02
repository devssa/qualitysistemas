<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class AgeRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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
        $dateOfBirth = new \DateTime(dateToUS($value));
        $year = $dateOfBirth->diff(new \DateTime());
        return $year->y <= 120;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'O :attribute é maior que 120 anos';
        // translate method
        // return trans('validation.age_rule')
    }
}
