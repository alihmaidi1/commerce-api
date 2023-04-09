<?php

namespace App\Rules;

use App\Models\property;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class checkPropertyRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {

        $keys=array_keys($value);
        $property=property::whereIn("id",$keys)->count();
        if($property!=count($keys)){
            $fail("The property is not exists");
        }
    }
}
