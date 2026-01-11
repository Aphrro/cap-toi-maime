<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class SwissPostalCode implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // Swiss postal codes are 4 digits, starting from 1000 to 9999
        if (!preg_match('/^[1-9]\d{3}$/', $value)) {
            $fail('Le code postal doit etre un code postal suisse valide (4 chiffres, ex: 1200).');
        }
    }
}
