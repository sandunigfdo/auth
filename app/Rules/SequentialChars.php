<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class SequentialChars implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $maxRepeat = 3;
        $repeatCount = 0;
        $lastChar = null;
        $valueChar = str_split($value);       

        for ($i=1; $i <= (strlen($value)-1); $i++) { 
            
            $lastChar = $valueChar[$i-1];
            $currentChar = $valueChar[$i];

            if ($lastChar == $currentChar) {
                $repeatCount++;
            }

            if ($repeatCount == $maxRepeat) {
                $fail('Your password doesn\'t meet our security standards');
            }
        }
    }
}
