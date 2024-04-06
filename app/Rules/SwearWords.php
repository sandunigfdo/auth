<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class SwearWords implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $lowercase = strtolower($value);

        $swear_words = array("fuck", "fuckyou", "shit", "pissoff", "dickhead", "asshole", "sonofabitch", 
        "bustard", "bitch", "damn", "cunt", "bollocks", "bugger", "bloodyhell", "choad", "crikey", "rubbish", 
        "shag", "wanker", "takingthepiss", "twat", "bloodyoath", "root", "getstuffed", "buggerme");

        $leetLetters = array(
            'a' => '4',
            'b' => '8',
            'e' => '3',
            'g' => '6',
            'i' => '1',
            'l' => '1',
            'o' => '0',
            'p' => '9',
            'q' => '2',
            'r' => '2',
            's' => '5',
            't' => '7',
            'z' => '2'
        );

        $swear_words_in_leet = [];

        // Loop through each word in above "swear_words" and create the leet code substituted word array
        foreach ($swear_words as $swear_word) {
            $word = $swear_word;
            $wordChars = str_split($word);
            $leetWord = '';

            // Loop through each letter in the word and substitute appropriate leet code
            for ($i=0; $i <= (strlen($word)-1); $i++) {
                // Is there a leet code for the current letter
                if (array_key_exists($wordChars[$i], $leetLetters)) {
                    // Substitute leet code
                    $leetWord .= $leetLetters[$wordChars[$i]];
                } else {
                    // Append letter
                    $leetWord .= $wordChars[$i];
                }
            }

            // Append current leet word into "swear_words_in_leet"
            array_push($swear_words_in_leet, $leetWord);
        }

        if (in_array("$lowercase", $swear_words) OR in_array("$lowercase", $swear_words_in_leet)) {
            $fail('Invalid username');
        }
    }
}
