<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class WeakPasswords implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $weakPasswordFile = storage_path('app/weakpasswords.txt');
        $weakPasswords = file($weakPasswordFile,FILE_IGNORE_NEW_LINES);

        if (in_array($value, $weakPasswords)) {
            $fail('Your password doesn\'t meet our security standards');
        }
    }
}
