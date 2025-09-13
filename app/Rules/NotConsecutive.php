<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class NotConsecutive implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $value = strtolower($value);

        $length = strlen($value);

        for($i = 0; $i < $length - 2; $i++){
            
            $first = ord($value[$i]);
            $second = ord($value[$i + 1]);
            $third = ord($value[$i + 2]);


            if($second === $first + 1 && $third === $second + 1){

                $fail(" The {$attribute} contains three or more consecutive characters.");

                return;
            }
        }
    }
}
