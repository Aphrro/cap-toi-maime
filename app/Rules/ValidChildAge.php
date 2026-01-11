<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidChildAge implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $age = (int) $value;

        if ($age < 0 || $age > 25) {
            $fail('L\'age de l\'enfant doit etre compris entre 0 et 25 ans.');
        }
    }
}
