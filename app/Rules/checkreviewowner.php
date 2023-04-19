<?php

namespace App\Rules;

use App\Models\review;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class checkreviewowner implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {

        $count=review::where("id",$value)->where("user_id",auth("user")->user()->id)->count();

        if($count==0){

            $fail("you dont have permission to do this action");

        }


    }
}
