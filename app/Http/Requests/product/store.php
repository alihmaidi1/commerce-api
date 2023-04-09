<?php

namespace App\Http\Requests\product;

use App\Rules\checkPropertyRule;
use Illuminate\Foundation\Http\FormRequest;

class store extends FormRequest
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
            "description"=>"required|string",
            "meta_title"=>"required|string",
            "meta_description"=>"required|string",
            "meta_logo"=>"required|exists:temps,id",
            "category_id"=>"required|exists:categories,id",
            "price"=>"required|numeric",
            "quantity"=>"required|min:0|integer",
            "min_quantity"=>"required|min:0|integer|lte:quantity",
            "currency_id"=>"required|exists:currencies,id",
            "brand_id"=>"required|exists:brands,id",
            "thumbnail"=>"required|exists:temps,id",
            "images"=>"required|array",
            "images.*"=>"required|exists:temps,id",
            "property"=>["array","required",new checkPropertyRule],
            "property.*"=>"required|string",
            "tags"=>"array",
            "tags.*"=>"required|exists:tags,id"
        ];
    }
}
