<?php

namespace App\Rules;

use Carbon\Carbon;
use Illuminate\Contracts\Validation\Rule;

class validateDatesOneYear implements Rule
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

        $date_start = request()->input('date_start');
        $date_end = request()->input('date_end');

        $date_start = Carbon::createFromFormat('Y-m-d', $date_start);
        $date_end = Carbon::createFromFormat('Y-m-d', $date_end);

        if ($date_start->diffInYears($date_end) >= 1) {
            return false;
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Data não pode ter diferença maior que 1 ano!';
    }
}
