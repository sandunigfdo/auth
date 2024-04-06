<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class BreachPassword implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $breachedPasswordFile = storage_path('app/breachedpasswords.txt');
        $breachedPasswords = file($breachedPasswordFile, FILE_IGNORE_NEW_LINES);
        
        if (in_array($value, $breachedPasswords)) {
            $fail('Your password doesn\'t meet our security standards');
        }
    }
}
