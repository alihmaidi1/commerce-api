<?php

namespace App\Rules;

use App\Models\image;
use App\Models\product;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Cache;

class checkImageProduct implements ValidationRule
{

    public $product;
    public function __construct($product){

        $this->product=$product;

    }
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */


    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $product_id=$this->product;


        $count=image::where("id",$value)->where("imageable_id",$product_id)->where("imageable_type","App\\Models\\product")->count();
        if(!$count){

            $fail("the image is not exists in our data");
        }




    }
}