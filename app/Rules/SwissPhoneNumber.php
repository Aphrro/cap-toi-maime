<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class SwissPhoneNumber implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // Remove all spaces for validation
        $cleaned = preg_replace('/\s+/', '', $value);

        // Swiss phone patterns:
        // +41XXXXXXXXX (11 digits with +41)
        // 0041XXXXXXXXX (13 digits with 0041)
        // 0XXXXXXXXX (10 digits starting with 0)
        $pattern = '/^(\+41|0041|0)\d{9}$/';

        if (!preg_match($pattern, $cleaned)) {
            $fail('Le numero de telephone doit etre un numero suisse valide (ex: +41 79 123 45 67).');
        }
    }
}
