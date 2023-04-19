<?php

namespace App\Rules;

use App\Models\product;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class checkQuantityProduct implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {

        $count=product::where("id",request("product_id"))->where("quantity",">=",$value)->count();

        if($count==0){

            $fail("this quantity is not exists in our store");

        }

    }
}