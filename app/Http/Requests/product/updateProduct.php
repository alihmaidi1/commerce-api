<?php

namespace App\Http\Requests\product;

use App\Rules\checkImageProduct;
use App\Rules\checkPropertyRule;
use Illuminate\Foundation\Http\FormRequest;

class updateProduct extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [

            "name"=>"required|string",
            "title"=>"required|string",
            "description"=>"required",
            "meta_title"=>"required",
            "meta_description"=>"required",
            "meta_logo"=>"exists:temps,id",
            "category_id"=>"required|exists:categories,id",
            "price"=>"required|numeric",
            "quantity"=>"required|gt:0",
            "min_quantity"=>"required|lte:quantity",
            "currency_id"=>"required|exists:currencies,id",
            "brand_id"=>"required|exists:brands,id",
            "thumbnail"=>"exists:temps,id",
            "deleted_image"=>"array",
            // "deleted_image.*"=>["required",new checkImageProduct(request("product"))],
            "deleted_image.*"=>["required","exists:images,id"],

            "images"=>"array",
            "images.*"=>"required|exists:temps,id",
            "property"=>["array","required",new checkPropertyRule]



        ];
    }
}
