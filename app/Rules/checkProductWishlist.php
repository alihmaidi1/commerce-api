<?php

namespace App\Rules;

use App\Models\wishlist;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class checkProductWishlist implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        //
        $count=wishlist::where("product_id",$value)->where("user_id",auth("user")->user()->id)->count();
        if($count==0){

            $fail("The product is not exists in our wishlist for this user");

        }

    }
}