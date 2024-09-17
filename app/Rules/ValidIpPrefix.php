<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidIpPrefix implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @param  Closure  $fail
     * @return void
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // Expresión regular para prefijos CIDR (ej. 192.168.1.0/24)
        $cidrPattern = '/^(?:\d{1,3}\.){3}\d{1,3}\/(?:[0-9]|[1-2][0-9]|3[0-2])$/';

        // Verifica si el valor es un prefijo CIDR valido
        if (!filter_var($value, FILTER_VALIDATE_IP) && !preg_match($cidrPattern, $value)) {
            $fail("The {$attribute} must be a valid IP address CIDR notation.");
        }
    }
}
